<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

$conn = getConnection();
$userId = $_SESSION['user_id'];

// 1. รับค่าคำค้นหาจากฟอร์มหน้าเว็บ
$keyword = $_GET['keyword'] ?? null;
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;

// 2. ดึงข้อมูลกิจกรรมตั้งต้น (ใช้ WHERE 1=1 เพื่อให้ต่อ AND ได้)
$sql = "SELECT e.*, 
        (SELECT COUNT(ID) FROM registrations WHERE event_id = e.event_id AND user_id = ?) as is_registered
        FROM events e 
        WHERE 1=1";

// ตัวแปรสำหรับผูกค่า (bind_param)
$params = [$userId];
$types  = "i";

// 3. เงื่อนไข: ค้นหาจาก "ชื่อกิจกรรม"
if (!empty($keyword)) {
    $sql .= " AND e.title LIKE ?";
    $params[] = "%" . $keyword . "%";
    $types .= "s";
}

// 4. เงื่อนไข: ค้นหาจาก "วันที่" (เช็คว่ากรอกอะไรมาบ้าง)
if (!empty($start_date) && !empty($end_date)) {
    // กรอกทั้งเริ่มและสิ้นสุด
    $sql .= " AND DATE(e.start_event) >= ? AND DATE(e.end_event) <= ?";
    $params[] = $start_date;
    $params[] = $end_date;
    $types .= "ss";
} elseif (!empty($start_date)) {
    // กรอกแค่วันที่เริ่มอย่างเดียว
    $sql .= " AND DATE(e.start_event) >= ?";
    $params[] = $start_date;
    $types .= "s";
} elseif (!empty($end_date)) {
    // กรอกแค่วันที่สิ้นสุดอย่างเดียว
    $sql .= " AND DATE(e.end_event) <= ?";
    $params[] = $end_date;
    $types .= "s";
}

// จัดเรียงลำดับใหม่สุดขึ้นก่อน
$sql .= " ORDER BY e.created_at DESC";

// Execute คำสั่ง SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// 5. วนลูปดึงรูปภาพ "ทั้งหมด" ของแต่ละกิจกรรมมาใส่กลับเข้าไป
foreach ($events as $key => $event) {
    $eventId = $event['event_id'];
    $imgSql = "SELECT image_path FROM event_images WHERE event_id = ?";
    $imgStmt = $conn->prepare($imgSql);
    $imgStmt->bind_param("i", $eventId);
    $imgStmt->execute();
    
    $images = $imgStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $events[$key]['images'] = array_column($images, 'image_path');
}

// ส่งข้อมูลไปที่หน้าจอ
renderView('dashboard', ['events' => $events]);
?>
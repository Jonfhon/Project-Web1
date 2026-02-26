<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

$conn = getConnection();
$userId = $_SESSION['user_id'];

// 1. ดึงข้อมูลกิจกรรม และเช็คว่าลงทะเบียนหรือยัง (ตัด Subquery รูปภาพออกไปก่อน)
$sql = "SELECT e.*, 
        (SELECT COUNT(ID) FROM registrations WHERE event_id = e.event_id AND user_id = ?) as is_registered
        FROM events e 
        ORDER BY e.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// 2. วนลูปดึงรูปภาพ "ทั้งหมด" ของแต่ละกิจกรรมมาใส่กลับเข้าไป
foreach ($events as $key => $event) {
    $eventId = $event['event_id'];
    $imgSql = "SELECT image_path FROM event_images WHERE event_id = ?";
    $imgStmt = $conn->prepare($imgSql);
    $imgStmt->bind_param("i", $eventId);
    $imgStmt->execute();
    
    // ดึงมาเป็น Array แล้วยัดใส่คีย์ชื่อ 'images'
    $images = $imgStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $events[$key]['images'] = array_column($images, 'image_path'); // จะได้ ['รูป1.jpg', 'รูป2.jpg']
}

renderView('dashboard', ['events' => $events]);
?>
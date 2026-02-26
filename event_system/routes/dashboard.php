<?php
if (!isset($_SESSION['user_id'])) { 
    header("Location: login"); 
    exit; 
}

$conn   = getConnection();
$userId = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| รับค่าค้นหา
|--------------------------------------------------------------------------
*/
$keyword    = $_GET['keyword'] ?? null;
$start_date = $_GET['start_date'] ?? null;
$end_date   = $_GET['end_date'] ?? null;

/*
|--------------------------------------------------------------------------
| SQL เดิม + เพิ่ม WHERE
|--------------------------------------------------------------------------
*/
$sql = "SELECT e.*, 
        (SELECT COUNT(ID) 
         FROM registrations 
         WHERE event_id = e.event_id 
         AND user_id = ?) as is_registered
        FROM events e
        WHERE 1=1";

$params = [$userId];
$types  = "i";

/*
|--------------------------------------------------------------------------
| ค้นหาจากชื่อ
|--------------------------------------------------------------------------
*/
if (!empty($keyword)) {
    $sql .= " AND e.title LIKE ?";
    $params[] = "%" . $keyword . "%";
    $types .= "s";
}

/*
|--------------------------------------------------------------------------
| ค้นหาจากช่วงวัน (ตรง ER Diagram)
|--------------------------------------------------------------------------
*/
if (!empty($start_date) && !empty($end_date)) {
    $sql .= " AND e.start_event <= ? AND e.end_event >= ?";
    $params[] = $end_date . " 23:59:59";
    $params[] = $start_date . " 00:00:00";
    $types .= "ss";
}

$sql .= " ORDER BY e.created_at DESC";

/*
|--------------------------------------------------------------------------
| Execute
|--------------------------------------------------------------------------
*/
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();

$events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


/*
|--------------------------------------------------------------------------
| ดึงรูปภาพ (เหมือนเดิม)
|--------------------------------------------------------------------------
*/
foreach ($events as $key => $event) {

    $eventId = $event['event_id'];

    $imgSql = "SELECT image_path FROM event_images WHERE event_id = ?";
    $imgStmt = $conn->prepare($imgSql);
    $imgStmt->bind_param("i", $eventId);
    $imgStmt->execute();

    $images = $imgStmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $events[$key]['images'] = array_column($images, 'image_path');
}

renderView('dashboard', ['events' => $events]);
?>
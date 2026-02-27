<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

$conn = getConnection();
$userId = $_SESSION['user_id'];

// 1. ดึงข้อมูลกิจกรรมที่ User คนนี้ลงทะเบียนไว้ (ใช้ JOIN เชื่อมตาราง events กับ registrations)
$sql = "SELECT e.*, r.status, r.registered_at 
        FROM events e 
        JOIN registrations r ON e.event_id = r.event_id 
        WHERE r.user_id = ? 
        ORDER BY r.registered_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// 2. วนลูปดึงรูปภาพของแต่ละกิจกรรม (ใช้โค้ด Slider เดิม)
foreach ($events as $key => $event) {
    $eventId = $event['event_id'];
    $imgSql = "SELECT image_path FROM event_images WHERE event_id = ?";
    $imgStmt = $conn->prepare($imgSql);
    $imgStmt->bind_param("i", $eventId);
    $imgStmt->execute();
    
    $images = $imgStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $events[$key]['images'] = array_column($images, 'image_path');
}

// ส่งข้อมูลไปแสดงที่หน้า joined_events
renderView('joined_events', ['events' => $events]);
?>
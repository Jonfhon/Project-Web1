<?php
declare(strict_types=1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$conn = getConnection();
$userId = $_SESSION['user_id'];

// ดึงข้อมูลกิจกรรมที่ฉันสร้าง
$sql = "SELECT * FROM events WHERE organizer_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$myEvents = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// ส่งข้อมูลไปที่หน้าตา (Template)
renderView('my_events', ['events' => $myEvents]);
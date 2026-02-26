<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$conn = getConnection();

// ดึงกิจกรรมทั้งหมด (ยกเว้นกิจกรรมที่หมดเวลาแล้ว หรือ กิจกรรมของเราเองตามแต่จะเลือก)
$sql = "SELECT * FROM events ORDER BY created_at DESC";
$result = $conn->query($sql);
$events = $result->fetch_all(MYSQLI_ASSOC);

renderView('dashboard', ['events' => $events]);
<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

$conn = getConnection();
$userId = $_SESSION['user_id'];

// ดึงกิจกรรมที่เคยสมัครไว้ทั้งหมด
$sql = "SELECT e.*, r.status as reg_status, r.reg_id 
        FROM registrations r 
        JOIN events e ON r.event_id = e.event_id 
        WHERE r.user_id = ? ORDER BY r.reg_id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$participations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

renderView('my_participations', ['participations' => $participations]);
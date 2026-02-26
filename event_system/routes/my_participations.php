<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

$conn = getConnection();
$userId = $_SESSION['user_id'];

$sql = "SELECT e.*, r.status as reg_status, r.ID as reg_id,
        (SELECT image_path FROM event_images WHERE event_id = e.event_id LIMIT 1) as image_path
        FROM registrations r 
        JOIN events e ON r.event_id = e.event_id 
        WHERE r.user_id = ? ORDER BY r.ID DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$participations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

renderView('my_participations', ['participations' => $participations]);
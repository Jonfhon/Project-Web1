<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

$conn = getConnection();

// ดึงกิจกรรม + รูปภาพแรกมา
$sql = "SELECT e.*, 
        (SELECT image_path FROM event_images WHERE event_id = e.event_id LIMIT 1) as image_path 
        FROM events e 
        ORDER BY e.created_at DESC";

$result = $conn->query($sql);
$events = $result->fetch_all(MYSQLI_ASSOC);

renderView('dashboard', ['events' => $events]);
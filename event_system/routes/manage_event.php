<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }
$conn = getConnection();
$userId = $_SESSION['user_id'];

// ลบกิจกรรม
if (isset($_GET['delete_id'])) {
    $delId = $_GET['delete_id'];
    $conn->query("DELETE FROM events WHERE event_id = $delId AND organizer_id = $userId");
    header("Location: my_events"); exit;
}

// ดึงกิจกรรมที่ตนเองเป็นเจ้าของ
$sql = "SELECT * FROM events WHERE organizer_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$myEvents = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

renderView('my_events', ['events' => $myEvents]);
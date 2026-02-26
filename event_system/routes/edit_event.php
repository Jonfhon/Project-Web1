<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }
$conn = getConnection();
$event_id = $_GET['id'] ?? 0;
$user_id = $_SESSION['user_id'];

// ถ้ามีการกดปุ่ม Save (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $loc = $_POST['location'];
    $start = $_POST['start_event'];
    $end = $_POST['end_event'];
    $max = $_POST['max_participants'];

    $sql = "UPDATE events SET title=?, description=?, location=?, start_event=?, end_event=?, max_participants=? WHERE event_id=? AND organizer_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiii", $title, $desc, $loc, $start, $end, $max, $event_id, $user_id);
    $stmt->execute();
    
    header("Location: my_events"); exit;
}

// ดึงข้อมูลเดิมมาแสดงในฟอร์ม
$sql = "SELECT * FROM events WHERE event_id=? AND organizer_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $event_id, $user_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

if (!$event) { header("Location: my_events"); exit; }
renderView('edit_event', ['event' => $event]);
?>
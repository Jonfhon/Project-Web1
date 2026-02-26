<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    $eventId = $_POST['event_id'];

    // เช็คว่าเคยสมัครยัง 
    $check = $conn->prepare("SELECT ID FROM registrations WHERE event_id = ? AND user_id = ?");
    $check->bind_param("ii", $eventId, $userId);
    $check->execute();
    
    if ($check->get_result()->num_rows === 0) {
        $sql = "INSERT INTO registrations (event_id, user_id, status) VALUES (?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $eventId, $userId);
        $stmt->execute();
    }
    header("Location: dashboard?msg=success");
    exit;
}
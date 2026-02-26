<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }
$conn = getConnection();
$reg_id = (int)($_GET['reg_id'] ?? 0);
$status = $_GET['status'] ?? '';
$event_id = (int)($_GET['event_id'] ?? 0);
$user_id = $_SESSION['user_id'];

if (in_array($status, ['approved', 'rejected'])) {
    // เช็คว่าคนกดอนุมัติ เป็นเจ้าของกิจกรรมนี้จริงๆ
    $sql = "SELECT e.organizer_id FROM registrations r JOIN events e ON r.event_id = e.event_id WHERE r.ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reg_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res && $res['organizer_id'] === $user_id) {
        $update = "UPDATE registrations SET status = ? WHERE ID = ?";
        $stmt2 = $conn->prepare($update);
        $stmt2->bind_param("si", $status, $reg_id);
        $stmt2->execute();
    }
}
// เด้งกลับไปหน้าดูรายชื่อเหมือนเดิม
header("Location: view_participants?id=" . $event_id);
exit;
?>
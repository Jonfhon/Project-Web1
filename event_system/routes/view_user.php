<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }
$conn = getConnection();
$uid = $_GET['id'] ?? 0;

$sql = "SELECT name, email, gender, date_of_birth, province FROM users WHERE UID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) { 
    echo "<script>alert('ไม่พบผู้ใช้งาน'); window.history.back();</script>"; exit; 
}
renderView('view_user', ['user' => $user]);
?>
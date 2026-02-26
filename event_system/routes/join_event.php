<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    $eventId = $_POST['event_id'];

    // ตรวจสอบว่าเคยสมัครไปหรือยัง
    $check = $conn->prepare("SELECT reg_id FROM registrations WHERE event_id = ? AND user_id = ?");
    $check->bind_param("ii", $eventId, $userId);
    $check->execute();
    
    if ($check->get_result()->num_rows === 0) {
        // บันทึกการเข้าร่วม (สถานะเริ่มต้นคือ pending)
        $sql = "INSERT INTO registrations (event_id, user_id, status) VALUES (?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $eventId, $userId);
        $stmt->execute();
    }
    
    // สมัครเสร็จให้เด้งไปหน้า "กิจกรรมที่ฉันเข้าร่วม"
    header("Location: dashboard?msg=joined_success");
    exit;
}
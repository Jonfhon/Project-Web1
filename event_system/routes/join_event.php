<?php
// 1. เช็คล็อกอิน
if (!isset($_SESSION['user_id'])) { 
    header("Location: login"); 
    exit; 
}

// 2. เช็คว่าส่งข้อมูลมาแบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();
    
    $userId = (int)$_SESSION['user_id'];
    $eventId = (int)$_POST['event_id'];

    // 3. เช็คว่าเป็นเจ้าของกิจกรรมหรือไม่ (ห้ามเข้าร่วมงานตัวเอง)
    $checkOwnerSql = "SELECT organizer_id FROM events WHERE event_id = ?";
    $checkOwnerStmt = $conn->prepare($checkOwnerSql);
    $checkOwnerStmt->bind_param("i", $eventId);
    $checkOwnerStmt->execute();
    $eventData = $checkOwnerStmt->get_result()->fetch_assoc();

    if ($eventData && $eventData['organizer_id'] === $userId) {
        header("Location: dashboard"); 
        exit;
    }

    // 4. เช็คว่าเคยลงทะเบียนไปหรือยัง (กันกดซ้ำ)
    $checkSql = "SELECT ID FROM registrations WHERE event_id = ? AND user_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $eventId, $userId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    // 5. ถ้ายังไม่เคยลงทะเบียน ให้บันทึกข้อมูล
    if ($result->num_rows === 0) {
        $insertSql = "INSERT INTO registrations (event_id, user_id, status) VALUES (?, ?, 'pending')";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ii", $eventId, $userId);
        
        // ถ้าบันทึกลงตาราง registrations สำเร็จ!
        if ($insertStmt->execute()) {
            
            // ==========================================
            // 🌟 พระเอกของเรา: สร้าง OTP ทันทีที่ลงทะเบียนเสร็จ
            // ==========================================
            $registrationId = $conn->insert_id; // ดึง ID ที่เพิ่งบันทึกเมื่อกี้
            
            require_once 'create_otp.php'; // นำเข้าโรงงานผลิต OTP
            generateEventOTP($conn, $registrationId); // สั่งสุ่มและบันทึก OTP ลงตาราง checkins
            // ==========================================

            header("Location: dashboard?msg=success"); // เด้งกลับหน้าหลัก
            exit;
        } else {
            die("เกิดข้อผิดพลาดในการลงทะเบียน: " . $conn->error);
        }
    } else {
        header("Location: dashboard?msg=already_registered"); // ถ้าเคยลงแล้ว
        exit;
    }
} else {
    header("Location: dashboard");
    exit;
}
?>
<?php
// 🌟 ตั้งโซนเวลาให้เป็นไทย เพื่อให้เช็คเวลาหมดอายุ และแสตมป์เวลาเข้างานได้เป๊ะๆ
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();
    
    $userId = (int)$_SESSION['user_id'];
    $eventId = (int)$_POST['event_id'];
    
    // รับรหัส OTP มาและตัดช่องว่างซ้ายขวาทิ้ง (เผื่อสต๊าฟเผลอกด Spacebar)
    $otpCode = trim($_POST['otp_code']);

    // 🛑 1. เช็คความปลอดภัย: คนที่กำลังตรวจบัตร เป็น "เจ้าของกิจกรรม" นี้จริงๆ ใช่ไหม?
    $checkOwnerSql = "SELECT organizer_id FROM events WHERE event_id = ?";
    $stmtOwner = $conn->prepare($checkOwnerSql);
    $stmtOwner->bind_param("i", $eventId);
    $stmtOwner->execute();
    $eventData = $stmtOwner->get_result()->fetch_assoc();

    if (!$eventData || $eventData['organizer_id'] !== $userId) {
        die("คุณไม่มีสิทธิ์จัดการกิจกรรมนี้!");
    }

    // 🔍 2. ค้นหารหัส OTP ในฐานข้อมูล (โดยต้องเป็นรหัสของกิจกรรมนี้เท่านั้น)
    // เราใช้ JOIN เพื่อเชื่อมตาราง checkins เข้ากับ registrations
    $sql = "SELECT c.ID as checkin_id, c.otp_expire_at, c.is_checked_in, r.status 
            FROM checkins c 
            JOIN registrations r ON c.registration_id = r.ID 
            WHERE c.otp_code = ? AND r.event_id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $otpCode, $eventId);
    $stmt->execute();
    $result = $stmt->get_result();

    // ------------------------------------------------------------------
    // 💡 แก้ไขตรงนี้: ให้เด้งกลับไปที่หน้า view_participants 
    $returnUrl = "view_participants?id=" . $eventId; 
    // ------------------------------------------------------------------

    if ($row = $result->fetch_assoc()) {
        
        // ❌ ด่าน 1: เช็คว่าสถานะถูก "อนุมัติ (approved)" ให้เข้างานหรือยัง?
        if ($row['status'] !== 'approved') {
            header("Location: " . $returnUrl . "&msg=not_approved");
            exit;
        }

        // ❌ ด่าน 2: เช็คว่ารหัสนี้ถูกใช้สแกนเข้างานไปแล้วหรือยัง? (กันคนเวียนเทียนใช้รหัสซ้ำ)
        if ($row['is_checked_in'] == 1) {
            header("Location: " . $returnUrl . "&msg=already_checked_in");
            exit;
        }

        // ❌ ด่าน 3: เช็คว่ารหัสหมดอายุหรือยัง? (เกิน 30 นาที)
        $currentTime = strtotime('now');
        $expireTime = strtotime($row['otp_expire_at']);
        
        if ($currentTime > $expireTime) {
            header("Location: " . $returnUrl . "&msg=otp_expired");
            exit;
        }

        // ✅ ผ่านทุกด่าน! ทำการแสตมป์เวลาเข้างาน
        $checkinTime = date('Y-m-d H:i:s'); // ดึงเวลาปัจจุบัน
        $updateSql = "UPDATE checkins SET is_checked_in = 1, checkin_time = ? WHERE ID = ?";
        
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $checkinTime, $row['checkin_id']);
        
        if ($updateStmt->execute()) {
            // สำเร็จ! เด้งกลับไปหน้าเดิมพร้อมข้อความ checkin_success
            header("Location: " . $returnUrl . "&msg=checkin_success");
            exit;
        } else {
            die("เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error);
        }

    } else {
        // ❌ ด่าน 0: หารหัสไม่เจอ (พิมพ์ผิด หรือเป็นรหัสของงานอื่น)
        header("Location: " . $returnUrl . "&msg=invalid_otp");
        exit;
    }

} else {
    // ถ้าไม่ได้กดปุ่ม Submit มา ให้เด้งกลับหน้าหลัก
    header("Location: dashboard");
    exit;
}
?>
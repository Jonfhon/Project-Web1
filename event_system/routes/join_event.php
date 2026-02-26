<?php
// 1. เช็คล็อกอิน
if (!isset($_SESSION['user_id'])) { 
    header("Location: login"); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();
    
    // 2. รับค่ามาแปลงเป็นตัวเลข (int) ป้องกันช่องโหว่ (SQL Injection) ได้ดียิ่งขึ้น
    $userId = (int)$_SESSION['user_id'];
    $eventId = (int)$_POST['event_id'];

    // ========================================================
    // 2.5 เพิ่มการเช็คว่าเป็นกิจกรรมของตัวเองหรือไม่ (กันคนแอบยิงข้อมูล)
    // ========================================================
    $checkOwnerSql = "SELECT organizer_id FROM events WHERE event_id = ?";
    $checkOwnerStmt = $conn->prepare($checkOwnerSql);
    $checkOwnerStmt->bind_param("i", $eventId);
    $checkOwnerStmt->execute();
    $eventData = $checkOwnerStmt->get_result()->fetch_assoc();

    // ถ้าพบว่า organizer_id ตรงกับคนที่ล็อกอินอยู่ แปลว่าเป็นคนสร้างเอง!
    if ($eventData && $eventData['organizer_id'] === $userId) {
        // ให้เด้งกลับไปหน้า dashboard เลย
        header("Location: dashboard"); 
        exit;
    }
    // ========================================================

    // 3. เช็คว่าเคยสมัครกิจกรรมนี้ไปแล้วหรือยัง
    $checkSql = "SELECT ID FROM registrations WHERE event_id = ? AND user_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $eventId, $userId);
    $checkStmt->execute();
    
    // ดึงผลลัพธ์ออกมาเก็บในตัวแปรเพื่อเช็คจำนวนแถว
    $result = $checkStmt->get_result();
    
    if ($result->num_rows === 0) {
        // 4. ยังไม่เคยสมัคร -> ทำการบันทึกข้อมูล
        $insertSql = "INSERT INTO registrations (event_id, user_id, status) VALUES (?, ?, 'pending')";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ii", $eventId, $userId);
        
        if ($insertStmt->execute()) {
            // สมัครสำเร็จ
            header("Location: dashboard?msg=success");
            exit;
        } else {
            // เผื่อมี Error ตอนบันทึก จะได้แสดงออกมาให้เราเห็น
            die("เกิดข้อผิดพลาดในการลงทะเบียน: " . $conn->error);
        }
    } else {
        // 5. เคยสมัครไปแล้ว -> เด้งกลับไปหน้าเดิมพร้อมส่งข้อความแจ้งเตือน
        header("Location: dashboard?msg=already_registered");
        exit;
    }
}
?>
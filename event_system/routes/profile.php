<?php
// ไฟล์: routes/profile.php

// 1. เรียกใช้งาน Connection จากไฟล์ database.php ของคุณ
$conn = getConnection();

// 2. กำหนด ID ผู้ใช้ (ถ้ายังไม่ได้ทำระบบล็อกอิน ให้ใช้ ID 1 ไปก่อนเพื่อทดสอบครับ)
$userId = $_SESSION['user_id'] ?? 1;

// 3. เตรียมคำสั่ง SQL (ใช้เครื่องหมาย ? แทนตัวแปรใน mysqli)
$sql = "SELECT name, email, gender, date_of_birth, province FROM users WHERE UID = ?";
$stmt = $conn->prepare($sql);

// ตรวจสอบว่าเตรียมคำสั่งสำเร็จไหม
if ($stmt) {
    // ผูกค่า $userId เข้ากับเครื่องหมาย ? ("i" หมายถึง Integer/ตัวเลข)
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    // ดึงผลลัพธ์ออกมา
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // ดึงมาเป็น Array
} else {
    // ถ้า SQL ผิดพลาด
    $user = null;
}

// 4. ถ้าหาข้อมูลไม่เจอ (เช่น ไม่มี ID นี้ในระบบ) ให้ตั้งค่าเริ่มต้นกัน Error
if (!$user) {
    $user = [
        'name' => 'ไม่พบข้อมูล',
        'email' => '-',
        'gender' => '-',
        'date_of_birth' => '-',
        'province' => '-'
    ];
}

// 5. ส่งตัวแปร $user เข้าไปให้หน้า View แสดงผล
renderView('profile', $user); 
?>
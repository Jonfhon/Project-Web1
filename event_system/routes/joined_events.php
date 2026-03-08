<?php
// 1. เช็คล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$conn = getConnection();
$userId = (int)$_SESSION['user_id'];

// 2. ดึงข้อมูลกิจกรรมที่ user คนนี้ลงทะเบียนไว้
// ไฮไลท์: ต้องดึง r.ID as registration_id มาด้วย เพื่อเอาไปใช้หา OTP
$sql = "SELECT e.*, 
               r.ID as registration_id, 
               r.status, 
               r.registered_at 
        FROM events e
        JOIN registrations r ON e.event_id = r.event_id
        WHERE r.user_id = ?
        ORDER BY r.registered_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// ========================================================
// 3. นำเข้าไฟล์โรงงานผลิต/เช็ค OTP
require_once 'create_otp.php'; 
// ========================================================

// 4. วนลูปจัดการรูปภาพ และ จัดการดึงรหัส OTP ให้แต่ละกิจกรรม
foreach ($events as $key => $event) {
    
    // --- ส่วนจัดการรูปภาพ ---
    $eventId = $event['event_id'];
    $imgSql = "SELECT image_path FROM event_images WHERE event_id = ?";
    $imgStmt = $conn->prepare($imgSql);
    $imgStmt->bind_param("i", $eventId);
    $imgStmt->execute();
    $images = $imgStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $events[$key]['images'] = array_column($images, 'image_path');
    
    // --- ส่วนจัดการ OTP (ดึงมาโชว์) ---
    $registrationId = $event['registration_id'];
    
    // เรียกใช้ฟังก์ชันดึง OTP (ถ้าหมดอายุ 30 นาที มันจะสุ่มเลขใหม่ให้เองเงียบๆ)
    $otpCode = refreshOTPIfNeeded($conn, $registrationId);
    
    // เอารหัสที่ได้ ยัดใส่ตัวแปร otp_code เตรียมส่งไปให้หน้าเว็บ HTML ดึงไปโชว์
    $events[$key]['otp_code'] = $otpCode;
}

// 5. ส่งข้อมูลทั้งหมดไปวาดหน้าจอ (ส่งไปหาไฟล์ HTML)
renderView('joined_events', ['events' => $events]);
?>
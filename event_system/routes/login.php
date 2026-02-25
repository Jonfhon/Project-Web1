<?php
// ถ้าล็อกอินอยู่แล้ว ให้เด้งไปหน้า dashboard เลย
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = loginUser($email);

    // ตรวจสอบรหัสผ่าน
    if ($user && password_verify($password, $user['password'])) {
        // เปลี่ยนตรงนี้เป็น UID (ตัวพิมพ์ใหญ่) ให้ตรงกับฐานข้อมูลใหม่
        $_SESSION['user_id'] = $user['UID']; 
        $_SESSION['name'] = $user['name'];
        
        echo "<script> window.location.href='dashboard';</script>";
        exit;
    } else {
        echo "<script>alert('อีเมลหรือรหัสผ่านไม่ถูกต้อง'); window.history.back();</script>";
        exit;
    }
}

// ถ้าเป็นการเข้าเว็บปกติ ให้แสดงหน้าฟอร์ม
renderView('login');
?>
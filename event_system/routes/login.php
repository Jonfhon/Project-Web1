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

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['uid'];
        $_SESSION['name'] = $user['name'];
        echo "<script>alert('เข้าสู่ระบบสำเร็จ'); window.location.href='dashboard';</script>";
        exit;
    } else {
        echo "<script>alert('อีเมลหรือรหัสผ่านไม่ถูกต้อง'); window.history.back();</script>";
        exit;
    }
}

renderView('login');
?>
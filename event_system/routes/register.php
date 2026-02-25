<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $dob = $_POST['date_of_birth'];
    $province = $_POST['province'];

    $result = registerUser($name, $email, $password, $gender, $dob, $province);
    
    if ($result === true) {
        echo "<script>alert('สมัครสมาชิกสำเร็จ!'); window.location.href='login';</script>";
        exit;
    } else {
        echo "<script>alert('$result'); window.history.back();</script>";
        exit;
    }
}

// ถ้าเป็นการเข้าเว็บปกติ (GET) ให้แสดงหน้าฟอร์ม
renderView('register');
?>
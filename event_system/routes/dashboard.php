<?php
// ดักไว้ไม่ให้คนที่ยังไม่ล็อกอินเข้าหน้านี้
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

renderView('dashboard');
?>
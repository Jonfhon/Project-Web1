<?php

$hostname = 'localhost';
$dbName = 'event_db'; // เชื่อมกับ phpMyAdmin ที่ชื่อ event_db
$username = 'root';
$password = '';
$conn = new mysqli($hostname, $username, $password, $dbName);

// ให้ฐานข้อมูลอ่านภาษาไทยได้ (เพิ่มบรรทัดนี้กันภาษาไทยเพี้ยนครับ)
$conn->set_charset("utf8mb4");

function getConnection(): mysqli
{
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// database functions ต่างๆ
require_once DATABASES_DIR . '/user_db.php';
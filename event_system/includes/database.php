<?php
$hostname = 'localhost';
$dbName = 'event_db'; 
$username = 'root';
$password = '';
$conn = new mysqli($hostname, $username, $password, $dbName);

$conn->set_charset("utf8mb4");

function getConnection(): mysqli
{
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

require_once DATABASES_DIR . '/user_db.php';
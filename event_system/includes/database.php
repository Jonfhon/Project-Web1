<?php
$hostname = 'mooncat.k1god.com';
$dbName = 'k1god_mooncat'; 
$username = 'k1god_mooncat';
$password = 'tuxT2^5yJcScdi9?';
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
require_once DATABASES_DIR . '/event_db.php';
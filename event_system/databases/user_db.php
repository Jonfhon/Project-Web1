<?php
declare(strict_types=1);

function registerUser(string $name, string $email, string $password, string $gender, string $dob, string $province)
{
    $conn = getConnection(); // เรียกใช้ฟังก์ชันจาก database.php
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, gender, date_of_birth, province) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $hashed_password, $gender, $dob, $province);

    try {
        $stmt->execute();
        return true; 
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            return "อีเมลนี้มีผู้ใช้งานในระบบแล้ว";
        } else {
            return "เกิดข้อผิดพลาดจากระบบ: " . $e->getMessage();
        }
    }
}

function loginUser(string $email)
{
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
?>
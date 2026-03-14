<?php
date_default_timezone_set('Asia/Bangkok');

function generateEventOTP($conn, $registrationId) {
    $otpCode = rand(100000, 999999);
    
    // ตั้งให้เวลา
    $expireAt = date('Y-m-d H:i:s', strtotime('+30 minute'));
    
    $otpSql = "INSERT INTO checkins (registration_id, otp_code, otp_expire_at, is_checked_in) 
               VALUES (?, ?, ?, 0)";
    
    $otpStmt = $conn->prepare($otpSql);
    $otpStmt->bind_param("iss", $registrationId, $otpCode, $expireAt);
    
    return $otpStmt->execute();
}

function refreshOTPIfNeeded($conn, $registrationId) {
    $sql = "SELECT ID, otp_code, otp_expire_at, is_checked_in FROM checkins WHERE registration_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $registrationId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        
        if ($row['is_checked_in'] == 1) {
            return $row['otp_code']; 
        }
        
        // ดึงเวลาปัจจุบัน และเวลาหมดอายุมาเทียบกัน
        $currentTime = strtotime('now');
        $expireTime = strtotime($row['otp_expire_at']);
        
        // ถ้าเวลาปัจจุบัน มากกว่า(เลย) เวลาหมดอายุแล้ว = สุ่มใหม่!
        if ($currentTime > $expireTime) {
            $newOtpCode = rand(100000, 999999);
            
            // ตั้งเวลาหมดอายุรอบใหม่ (1 นาที)
            $newExpireAt = date('Y-m-d H:i:s', strtotime('+30 minute'));
            
            $updateSql = "UPDATE checkins SET otp_code = ?, otp_expire_at = ? WHERE ID = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ssi", $newOtpCode, $newExpireAt, $row['ID']);
            $updateStmt->execute();
            
            return $newOtpCode; 
        }
        
        return $row['otp_code'];
    }
    
    return null; 
}
?>
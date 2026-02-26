<?php


$conn = getConnection();
// ดึง ID ผู้ใช้ (ถ้ายังไม่มีระบบล็อกอิน ใช้ ID 1 ทดสอบไปก่อน)
$userId = $_SESSION['user_id'] ?? 1;

// --- ส่วนที่ 1: ตรวจสอบว่ามีการกดปุ่ม "บันทึกข้อมูล" (POST) มาหรือไม่ ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['date_of_birth'];
    $province = $_POST['province'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล (แก้ไขชื่อคอลัมน์ user_id ให้ตรงกับ Database คุณด้วยนะ)
    $updateSql = "UPDATE users SET name = ?, email = ?, gender = ?, date_of_birth = ?, province = ? WHERE UID = ?";
    $stmtUpdate = $conn->prepare($updateSql);
    
    if ($stmtUpdate) {
        // ผูกค่าและบันทึก (s = string, i = integer)
        $stmtUpdate->bind_param("sssssi", $name, $email, $gender, $dob, $province, $userId);
        
        if ($stmtUpdate->execute()) {
            // บันทึกสำเร็จ ให้เด้งกลับไปหน้าโปรไฟล์
            header("Location: profile");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
        }
    }
}

// --- ส่วนที่ 2: ดึงข้อมูลเดิมมาแสดงในฟอร์ม (เหมือนหน้า Profile เลย) ---
$sql = "SELECT name, email, gender, date_of_birth, province FROM users WHERE UID = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if (!$user) {
    // กัน Error กรณีหาข้อมูลไม่เจอ
    $user = ['name' => '', 'email' => '', 'gender' => '', 'date_of_birth' => '', 'province' => ''];
}

// ส่งข้อมูล $user ไปแสดงในหน้าฟอร์มแก้ไข
renderView('edit_profile', $user);
?>
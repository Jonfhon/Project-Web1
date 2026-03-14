<?php
declare(strict_types=1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$conn = getConnection();
$userId = $_SESSION['user_id'];

$success_msg = '';
$error_msg = '';



// ส่วนที่เพิ่มใหม่: จัดการการ "ลบกิจกรรม"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_event'])) {
    $delete_id = (int)($_POST['delete_event_id'] ?? 0);

    if ($delete_id > 0) {
        $delete_sql = "DELETE FROM events WHERE event_id = ? AND organizer_id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        $stmt_delete->bind_param("ii", $delete_id, $userId);
        
        if ($stmt_delete->execute()) {
            if ($stmt_delete->affected_rows > 0) {
                $success_msg = "ลบกิจกรรมเรียบร้อยแล้ว!";
            } else {
                $error_msg = "ไม่สามารถลบได้: ไม่พบกิจกรรม หรือคุณไม่มีสิทธิ์ลบกิจกรรมนี้";
            }
        } else {
            $error_msg = "เกิดข้อผิดพลาดจากฐานข้อมูล: " . $conn->error;
        }
        $stmt_delete->close();
    } else {
        $error_msg = "ข้อมูลกิจกรรมไม่ถูกต้อง";
    }
}


// ดึงข้อมูลกิจกรรมที่ฉันสร้าง (ดึงหลังจากลบเสร็จแล้ว เพื่อให้หน้าเว็บอัปเดตทันที)
$sql = "SELECT * FROM events WHERE organizer_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$myEvents = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// ส่งข้อมูลกิจกรรม พร้อมข้อความแจ้งเตือนไปที่หน้าเว็บ
renderView('my_events', [
    'events'  => $myEvents,
    'success' => $success_msg,
    'error'   => $error_msg
]);
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

// รับค่า id กิจกรรมจาก URL
$event_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($event_id === 0) {
    echo "<script>alert('ไม่พบข้อมูลกิจกรรม'); window.location.href='my_events';</script>";
    exit;
}

$event = getEventDetails($event_id);

// ตรวจสอบว่าเป็นเจ้าของกิจกรรมหรือไม่ (ป้องกันคนอื่นแอบดู)
if (!$event || $event['organizer_id'] !== $_SESSION['user_id']) {
    echo "<script>alert('คุณไม่มีสิทธิ์ดูข้อมูลกิจกรรมนี้'); window.location.href='my_events';</script>";
    exit;
}

// =========================================================================
// 🌟 ส่วนที่แก้ไข: เขียนคำสั่ง SQL ดึงข้อมูลใหม่ตรงนี้เลย (ดึงข้อมูล checkin มาด้วย)
// =========================================================================
$conn = getConnection();
$sql = "SELECT r.ID as reg_id, r.status, r.registered_at, 
               u.UID, u.name, u.email, u.gender, u.province,
               c.is_checked_in, c.checkin_time 
        FROM registrations r
        JOIN users u ON r.user_id = u.UID
        LEFT JOIN checkins c ON r.ID = c.registration_id 
        WHERE r.event_id = ?
        ORDER BY r.registered_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$participants = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
// =========================================================================

// ส่งข้อมูลไปให้หน้า Template
renderView('view_participants', [
    'event' => $event,
    'participants' => $participants
]);
?>
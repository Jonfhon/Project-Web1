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

$participants = getEventParticipants($event_id);

// ส่งข้อมูลไปให้หน้า Template
renderView('view_participants', [
    'event' => $event,
    'participants' => $participants
]);
?>
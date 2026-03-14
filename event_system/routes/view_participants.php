<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}


$event_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($event_id === 0) {
    echo "<script>alert('ไม่พบข้อมูลกิจกรรม'); window.location.href='my_events';</script>";
    exit;
}

$event = getEventDetails($event_id);


if (!$event || $event['organizer_id'] !== $_SESSION['user_id']) {
    echo "<script>alert('คุณไม่มีสิทธิ์ดูข้อมูลกิจกรรมนี้'); window.location.href='my_events';</script>";
    exit;
}


$conn = getConnection();
$sql = "SELECT r.ID as reg_id, r.status, r.registered_at, 
               u.UID, u.name, u.email, u.gender, u.province, u.date_of_birth, 
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



$stat_total = count($participants);

// เตรียมตัวแปรสถิติเพศ
$gender_male = 0;
$gender_female = 0;
$gender_other = 0;

// เตรียมตัวแปรสถิติช่วงอายุ
$age_under_18 = 0;
$age_18_25 = 0;
$age_26_35 = 0;
$age_36_45 = 0;
$age_over_45 = 0;

$today = new DateTime(); // ดึงวันที่ปัจจุบันมาเป็นฐานในการลบกับวันเกิด

// วนลูปเช็คผู้สมัครทีละคน เพื่อหยอดเหรียญลงตะกร้าสถิติ
foreach ($participants as $p) {
    
    // 1️⃣ นับเพศ
    if ($p['gender'] === 'Male') {
        $gender_male++;
    } elseif ($p['gender'] === 'Female') {
        $gender_female++;
    } else {
        $gender_other++;
    }

    // 2️⃣ คำนวณอายุจากวันเกิด แล้วแยกช่วงอายุ
    if (!empty($p['date_of_birth'])) {
        $dob = new DateTime($p['date_of_birth']);
        $age = $today->diff($dob)->y;

        if ($age < 18) {
            $age_under_18++;
        } elseif ($age >= 18 && $age <= 25) {
            $age_18_25++;
        } elseif ($age >= 26 && $age <= 35) {
            $age_26_35++;
        } elseif ($age >= 36 && $age <= 45) {
            $age_36_45++;
        } else {
            $age_over_45++;
        }
    }
}

renderView('view_participants', [
    'event' => $event,
    'participants' => $participants,
    
    'stat_total' => $stat_total,
    'gender_male' => $gender_male,
    'gender_female' => $gender_female,
    'gender_other' => $gender_other,
    'age_under_18' => $age_under_18,
    'age_18_25' => $age_18_25,
    'age_26_35' => $age_26_35,
    'age_36_45' => $age_36_45,
    'age_over_45' => $age_over_45
]);
?>
<?php
if (!isset($_SESSION['user_id'])) { 
    header("Location: login"); 
    exit; 
}

$conn = getConnection();
$event_id = (int)($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];

// 🚨 ด่านตรวจ: เช็คก่อนว่าผู้ใช้คนนี้เป็น "เจ้าของกิจกรรม" จริงๆ
$sql = "SELECT * FROM events WHERE event_id=? AND organizer_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $event_id, $user_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

if (!$event) { 
    header("Location: my_events"); 
    exit; 
}

// ==========================================
// 🛠️ ส่วนประมวลผลเมื่อกดปุ่ม "บันทึกการแก้ไข" (POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $loc = $_POST['location'];
    $start = $_POST['start_event'];
    $end = $_POST['end_event'];
    $max = (int)$_POST['max_participants'];

    // 1️⃣ อัปเดตข้อมูลข้อความทั่วไป (ในตาราง events)
    $sql_update = "UPDATE events SET title=?, description=?, location=?, start_event=?, end_event=?, max_participants=? WHERE event_id=? AND organizer_id=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssiii", $title, $desc, $loc, $start, $end, $max, $event_id, $user_id);
    $stmt_update->execute();
    
    // 2️⃣ จัดการ "ลบรูปภาพ" (ถ้ามีการติ๊กถูกที่รูป)
    if (!empty($_POST['delete_images'])) {
        // เตรียมคำสั่งลบข้อมูลออกจากตาราง event_images
        $del_img_sql = "DELETE FROM event_images WHERE event_id=? AND image_path=?";
        $stmt_del = $conn->prepare($del_img_sql);
        
        foreach ($_POST['delete_images'] as $img_to_delete) {
            // ลบไฟล์ภาพจริงๆ ออกจากโฟลเดอร์เซิร์ฟเวอร์ก่อน
            $file_path = "assets/uploads/" . $img_to_delete;
            if (file_exists($file_path)) {
                unlink($file_path); 
            }
            // สั่ง Execute ลบข้อมูลในฐานข้อมูล
            $stmt_del->bind_param("is", $event_id, $img_to_delete);
            $stmt_del->execute();
        }
    }

    // 3️⃣ จัดการ "เพิ่มรูปภาพใหม่" (ถ้ามีการเลือกไฟล์เข้ามา)
    if (!empty($_FILES['new_images']['name'][0])) {
        $upload_dir = 'assets/uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true); 

        // เตรียมคำสั่งเพิ่มข้อมูลลงตาราง event_images
        $insert_img_sql = "INSERT INTO event_images (event_id, image_path) VALUES (?, ?)";
        $stmt_in = $conn->prepare($insert_img_sql);

        foreach ($_FILES['new_images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['new_images']['error'][$key] === 0) {
                $file_ext = strtolower(pathinfo($_FILES['new_images']['name'][$key], PATHINFO_EXTENSION));
                $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 
                
                if (in_array($file_ext, $allowed_ext)) {
                    // ตั้งชื่อไฟล์ใหม่ให้ไม่ซ้ำกัน
                    $new_file_name = uniqid('event_', true) . '.' . $file_ext;
                    $destination = $upload_dir . $new_file_name;
                    
                    if (move_uploaded_file($tmp_name, $destination)) {
                        // เซฟชื่อไฟล์ใหม่ลงฐานข้อมูล (ใช้คอลัมน์ image_path ตามที่คุณออกแบบไว้)
                        $stmt_in->bind_param("is", $event_id, $new_file_name);
                        $stmt_in->execute();
                    }
                }
            }
        }
    }
    
    // เสร็จแล้วเด้งกลับไปหน้ากิจกรรมของฉัน พร้อมแนบ success กลับไปโชว์แจ้งเตือน
    header("Location: my_events?success=1"); 
    exit;
}

// ==========================================
// 🖼️ ดึงข้อมูลรูปภาพปัจจุบันมาแสดงผลให้ HTML
// ==========================================
$img_sql = "SELECT image_path FROM event_images WHERE event_id=?";
$stmt_img = $conn->prepare($img_sql);
$stmt_img->bind_param("i", $event_id);
$stmt_img->execute();
$img_result = $stmt_img->get_result();

$event['images'] = []; // เตรียมกล่อง Array ว่าง
while ($row = $img_result->fetch_assoc()) {
    $event['images'][] = $row['image_path']; // เอาชื่อรูปยัดใส่กล่องส่งให้ HTML
}

// ส่งข้อมูลไปหน้าเว็บ (หน้า HTML ตัวล่าสุดที่ให้ไปจะดึงรูปไปโชว์ได้ทันที)
renderView('edit_event', ['event' => $event]);
?>
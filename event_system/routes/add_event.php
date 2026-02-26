<?php
if (!isset($_SESSION['user_id'])) { header("Location: login"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $start_event = $_POST['start_event'];
    $end_event = $_POST['end_event'];
    $max_participants = (int)$_POST['max_participants'];

    // บันทึกข้อมูลกิจกรรม
    $sql = "INSERT INTO events (organizer_id, title, description, location, start_event, end_event, max_participants) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssi", $userId, $title, $description, $location, $start_event, $end_event, $max_participants);

    if ($stmt->execute()) {
        $eventId = $conn->insert_id;

        // วนลูปบันทึกหลายรูปภาพ
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['images']['error'][$key] === 0) {
                    $newName = uniqid() . "_" . time() . "_" . $key . ".jpg";
                    if (move_uploaded_file($tmpName, "assets/uploads/" . $newName)) {
                        $imgSql = "INSERT INTO events (event_id, image_path) VALUES (?, ?)";
                        $imgStmt = $conn->prepare($imgSql);
                        $imgStmt->bind_param("is", $eventId, $newName);
                        $imgStmt->execute();
                    }
                }
            }
        }
        header("Location: dashboard");
        exit;
    }
}
renderView('add_event');

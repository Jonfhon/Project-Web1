<?php
declare(strict_types=1);

// ดึงข้อมูลรายละเอียดของกิจกรรม
function getEventDetails(int $event_id) {
    $conn = getConnection();
    $sql = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getEventParticipants(int $event_id) {
    $conn = getConnection();
    $sql = "SELECT r.ID as reg_id, r.status, r.registered_at, 
                   u.UID, u.name, u.email, u.gender, u.province 
            FROM registrations r
            JOIN users u ON r.user_id = u.UID
            WHERE r.event_id = ?
            ORDER BY r.registered_at ASC";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
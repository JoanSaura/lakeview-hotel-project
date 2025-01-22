<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');

$room_number = isset($_GET['room_number']) && !empty($_GET['room_number']) ? $_GET['room_number'] : null;

$sql = "SELECT 
    r.room_number AS room_number, 
    r.room_status AS room_status, 
    rt.room_type_name AS room_type_name, 
    rt.room_type_price_per_day AS room_price_per_day
FROM 
    071_rooms r
JOIN 
    071_room_type rt ON r.room_type_id = rt.room_type_id";

if ($room_number) {
    $sql .= " WHERE r.room_number LIKE '%" . $conn->real_escape_string($room_number) . "%'";
}

$result = mysqli_query($conn, $sql);

$rooms = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row; 
    }
}

if ($room_number) {
    header('Content-Type: application/json');
    echo json_encode($rooms); 
    exit;
}

mysqli_free_result($result);
mysqli_close($conn);

return $rooms;
?>

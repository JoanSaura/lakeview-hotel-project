<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');

$sql = "SELECT 
    r.room_number AS room_number, 
    r.room_status AS room_status, 
    rt.room_type_name AS room_type_name, 
    rt.room_type_price_per_day AS room_price_per_day
FROM 
    071_rooms r
JOIN 
    071_room_type rt ON r.room_type_id = rt.room_type_id";

$result = mysqli_query($conn, $sql);

$rooms = array();

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row; 
    }
}

mysqli_free_result($result);
mysqli_close($conn);

return $rooms;
?>

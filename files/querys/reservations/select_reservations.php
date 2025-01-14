<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');

$client_name = isset($_GET['client_name']) ? trim($_GET['client_name']) : '';

$sql = "
    SELECT 
        res.reservation_id,
        c.client_first_name AS 071_client_first_name,
        c.client_last_name AS 071_client_last_name,
        r.room_number AS 071_room_number,
        rt.room_type_name AS 071_room_type_name,
        rt.room_type_price_per_day AS 071_room_price_per_day,
        res.date_in AS 071_date_in,
        res.date_out AS 071_date_out,
        DATEDIFF(res.date_out, res.date_in) AS 071_total_days,
        DATEDIFF(res.date_out, res.date_in) * rt.room_type_price_per_day AS 071_total_price
    FROM 
        071_reservations res
    JOIN 
        071_customers c ON res.client_id = c.client_id
    JOIN 
        071_rooms r ON res.room_id = r.room_id
    JOIN 
        071_room_type rt ON r.room_type_id = rt.room_type_id
";

if (!empty($client_name)) {
    $sql .= " WHERE CONCAT(c.client_first_name, ' ', c.client_last_name) LIKE '%" . $conn->real_escape_string($client_name) . "%'";
}

$result = $conn->query($sql);

$reservations = array();

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

mysqli_free_result($result);
mysqli_close($conn);

if (!empty($_GET['client_name'])) {
    header(header: 'Content-Type: application/json');
    echo json_encode($reservations);
    exit; 
}

return $reservations;
?>

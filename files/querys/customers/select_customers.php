<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
$client_name = isset($_GET['client_name']) ? trim($_GET['client_name']) : '';

$sql = "SELECT client_id, client_first_name, client_last_name, client_identification, client_email, client_phone_number
        FROM 071_customers";

if (!empty($client_name)) {
    $sql .= " WHERE CONCAT(client_first_name, ' ', client_last_name) LIKE '%" . $conn->real_escape_string($client_name) . "%'";
}

$result = mysqli_query($conn, $sql);

$customers = array();

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
}

if (!empty($_GET['client_name'])) {
    header(header: 'Content-Type: application/json');
    echo json_encode($reservations);
    exit; 
}

mysqli_free_result($result);
mysqli_close($conn);

return $customers;

?>
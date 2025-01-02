<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');

$sql = "SELECT client_id, client_first_name, client_last_name, client_identification, client_email, client_phone_number
        FROM 071_customers";

$result = mysqli_query($conn, $sql);

$customers = array();

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
}

mysqli_free_result($result);
mysqli_close($conn);

return $customers;

?>
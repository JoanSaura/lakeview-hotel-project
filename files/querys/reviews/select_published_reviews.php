<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');

$sql = "SELECT * FROM 071_reviews WHERE accepted = 1 AND reviewed = 1 ORDER BY inserted_on DESC";
$result = mysqli_query($conn, $sql);

$reviews = array();

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
}

mysqli_free_result($result);
mysqli_close($conn);

return $reviews;

?>

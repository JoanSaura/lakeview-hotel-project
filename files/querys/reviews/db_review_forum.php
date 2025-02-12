<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db-connection.php');

$sql = 'SELECT * FROM 071_reviews';
$result = mysqli_query($conn, $sql);


?>
<?php
$root = $_SERVER['DOCUMENT_ROOT'];

$conn = mysqli_connect('localhost', 'root', '', '071_hotel_managment');

if (!$conn) {
    die('Connection error: ' . mysqli_connect_error());
}

return $conn;
?>

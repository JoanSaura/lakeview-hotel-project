<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/functions/showPopUp.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationId = intval($_POST['reservation-id']);
    $clientId = intval($_POST['client-id']);
    $roomId = intval($_POST['room-id']);
    $dateIn = mysqli_real_escape_string($conn, $_POST['date-in']);
    $dateOut = mysqli_real_escape_string($conn, $_POST['date-out']);
    $state = mysqli_real_escape_string($conn, $_POST['reservation-state']);
    $today = date("Y-m-d");

    // Validación para prevenir fechas pasadas
    if ($dateIn < $today || $dateOut < $today) {
        showPopup("Error: Las fechas no pueden ser en el pasado.", 'error', $_SERVER['HTTP_REFERER']);
        mysqli_close($conn);
        exit();
    }

    $sqlUpdate = "UPDATE 071_reservations 
                  SET client_id = '$clientId', room_id = '$roomId', date_in = '$dateIn', date_out = '$dateOut', reservation_state = '$state' 
                  WHERE reservation_id = '$reservationId'";

    if (mysqli_query($conn, $sqlUpdate)) {
        showPopup("Reservation updated successfully.", 'success', '/student071/dwes/index.php');
    } else {
        showPopup("Error updating reservation: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
    }

    mysqli_close($conn);
    exit();
}
?>

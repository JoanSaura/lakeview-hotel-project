<?php 
$root = $_SERVER['DOCUMENT_ROOT']; 
include($root . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationId = intval($_POST['reservation-id']);

    $sqlDeleteInvoice = "DELETE FROM 071_invoices WHERE reservation_id = '$reservationId'";
    if (mysqli_query($conn, $sqlDeleteInvoice)) {
        $sqlDeleteReservation = "DELETE FROM 071_reservations WHERE reservation_id = '$reservationId'";
        
        if (mysqli_query($conn, $sqlDeleteReservation)) {
            showPopup("Reservation and associated invoice deleted successfully.", 'success', '/student071/dwes/index.php');
        } else {
            showPopup("Error deleting reservation: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
        }
    } else {
        showPopup("Error deleting invoice: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
    }

    mysqli_close($conn);
    exit();
}
?>

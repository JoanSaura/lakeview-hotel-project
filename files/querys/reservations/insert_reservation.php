<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['client-id'], $_POST['date-in'], $_POST['date-out'])) {
        $client_id = (int) $_POST['client-id'];
        $date_in = mysqli_real_escape_string($conn, $_POST['date-in']);
        $date_out = mysqli_real_escape_string($conn, $_POST['date-out']);
        $today = date("Y-m-d");

        if ($date_in < $today || $date_out < $today || $date_out <= $date_in) {
            header("Location: /student071/dwes/index.php");
            exit();
        }

        $room_id = (isset($_POST['room-id']) && !empty($_POST['room-id'])) ? (int) $_POST['room-id'] : 0;
        $price_per_day = isset($_POST['price-per-day']) ? (float) $_POST['price-per-day'] : 0.0;

        $total_days = (strtotime($date_out) - strtotime($date_in)) / (60 * 60 * 24);
        $invoice_total = $total_days * $price_per_day;

        $sql_reservation = "INSERT INTO 071_reservations (client_id, room_id, date_in, date_out, reservation_price_per_day) 
                            VALUES ($client_id, $room_id, '$date_in', '$date_out', $price_per_day)";

        if (mysqli_query($conn, $sql_reservation)) {
            $reservation_id = mysqli_insert_id($conn);

            $invoice_status = 'unpaid';
            $sql_invoice = "INSERT INTO 071_invoices (reservation_id, client_id, room_id, date_in, date_out, total_days, invoice_status, invoice_total) 
                            VALUES ($reservation_id, $client_id, $room_id, '$date_in', '$date_out', $total_days, '$invoice_status', $invoice_total)";

            if (mysqli_query($conn, $sql_invoice)) {
                showPopup("Reservation and invoice successfully booked!", 'success', '/student071/dwes/index.php');
            } else {
                showPopup("Error creating invoice: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
            }
        } else {
            showPopup("Error creating reservation: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
        }

    } else {
        showPopup("Required data missing.", 'error', $_SERVER['HTTP_REFERER']);
    }
    mysqli_close($conn);
} else {
    showPopup("Invalid request method.", 'error', $_SERVER['HTTP_REFERER']);
}
?>

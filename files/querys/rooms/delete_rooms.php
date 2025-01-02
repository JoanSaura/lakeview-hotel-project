<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomNumber = intval($_POST['room-number']);

    $sqlCheck = "SELECT * FROM 071_rooms WHERE room_number = '$roomNumber'";
    $resultCheck = mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        $sqlDelete = "DELETE FROM 071_rooms WHERE room_number = '$roomNumber'";

        if (mysqli_query($conn, $sqlDelete)) {
            showPopup("Room deleted successfully!", 'success', '/student071/dwes/files/admin_page.php');
        } else {
            showPopup("Error deleting room: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
        }
    } else {
        showPopup("Room not found!", 'error', $_SERVER['HTTP_REFERER']);
    }

    mysqli_free_result($resultCheck);
    mysqli_close($conn);
} else {
    showPopup("Invalid request method.", 'error', $_SERVER['HTTP_REFERER']);
}
?>

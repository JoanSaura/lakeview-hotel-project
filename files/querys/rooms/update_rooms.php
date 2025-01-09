<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/functions/showPopUp.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $originalRoomNumber = intval($_POST['room-number']); 
    $newRoomNumber = intval($_POST['room-number-input']); 
    $roomTypeId = intval($_POST['room-type']);  

    $sqlCheck = "SELECT * FROM 071_rooms WHERE room_number = '$originalRoomNumber'";
    $resultCheck = mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        $sqlUpdate = "
            UPDATE 071_rooms 
            SET room_number = '$newRoomNumber', room_type_id = '$roomTypeId' 
            WHERE room_number = '$originalRoomNumber'";

        if (mysqli_query($conn, $sqlUpdate)) {
            showPopup("Room updated successfully!", 'success', '/student071/dwes/files/admin_page.php');
        } else {
            showPopup("Error updating room: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
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

<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/functions/showPopUp.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomNumber = mysqli_real_escape_string($conn, $_POST['room-number']);
    $roomTypeId = mysqli_real_escape_string($conn, $_POST['room-type']);
    $roomStatus = "Free"; 

    $sqlInsert = "
        INSERT INTO 071_rooms (room_number, room_type_id, room_status) 
        VALUES ('$roomNumber', '$roomTypeId', '$roomStatus')
    ";

    if (mysqli_query($conn, $sqlInsert)) {
        showPopup("Room created successfully!", 'success', '/student071/dwes/files/admin_page.php');
    } else {
        showPopup("Error: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
    }

    mysqli_close($conn);
} else {
    showPopup("Invalid request method.", 'error', $_SERVER['HTTP_REFERER']);
}
?>

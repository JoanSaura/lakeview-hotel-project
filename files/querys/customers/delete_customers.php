<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clientId = intval($_POST['client-id']);

    $sqlCheck = "SELECT * FROM 071_customers WHERE client_id = '$clientId'";
    $resultCheck = mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        $sqlDeleteUser = "DELETE FROM 071_users WHERE client_id = '$clientId'";
        if (mysqli_query($conn, $sqlDeleteUser)) {
            $sqlDeleteCustomer = "DELETE FROM 071_customers WHERE client_id = '$clientId'";
            if (mysqli_query($conn, $sqlDeleteCustomer)) {
                showPopup("Customer and associated user deleted successfully!", 'success', '/student071/dwes/index.php');
            } else {
                showPopup("Error deleting customer: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
            }
        } else {
            showPopup("Error deleting user: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
        }
    } else {
        showPopup("Customer not found!", 'error', $_SERVER['HTTP_REFERER']);
    }

    mysqli_free_result($resultCheck);
    mysqli_close($conn);
} else {
    showPopup("Invalid request method.", 'error', $_SERVER['HTTP_REFERER']);
}
?>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/functions/showPopUp.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['client-id'])) {
        $clientId = intval($_POST['client-id']);

        $firstName = isset($_POST['first-name']) ? mysqli_real_escape_string($conn, $_POST['first-name']) : null;
        $lastName = isset($_POST['last-name']) ? mysqli_real_escape_string($conn, $_POST['last-name']) : null;
        $identification = isset($_POST['identification']) ? mysqli_real_escape_string($conn, $_POST['identification']) : null;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
        $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : null;

        $sqlUpdateCustomer = "UPDATE 071_customers SET 
                                client_first_name = '$firstName', 
                                client_last_name = '$lastName', 
                                client_identification = '$identification', 
                                client_email = '$email', 
                                client_phone_number = '$phone' 
                              WHERE client_id = $clientId";

        if (mysqli_query($conn, $sqlUpdateCustomer)) {
            $sqlUpdateUser = "UPDATE 071_users SET 
                                user_online = '$firstName', 
                                user_mail = '$email', 
                                user_password = '$password' 
                              WHERE client_id = $clientId"; 

            if (mysqli_query($conn, $sqlUpdateUser)) {
                showPopup("Customer and user updated successfully!", 'success', '/student071/dwes/files/admin_page.php');
            } else {
                showPopup("Error updating user: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
            }
        } else {
            showPopup("Error updating customer: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
        }
    } else {
        showPopup("Client ID is missing.", 'error', $_SERVER['HTTP_REFERER']);
    }

    mysqli_close($conn);
} else {
    showPopup("Invalid request method.", 'error', $_SERVER['HTTP_REFERER']);
}
?>

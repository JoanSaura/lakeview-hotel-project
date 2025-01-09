<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/functions/showPopUp.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = mysqli_real_escape_string($conn, $_POST['c-first-name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['c-last-name']);
    $identification = mysqli_real_escape_string($conn, $_POST['c-identification']);
    $email = mysqli_real_escape_string($conn, $_POST['c-email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['c-phonenumber']);
    $password = mysqli_real_escape_string($conn, $_POST['c-password']); 

    $customerSql = "INSERT INTO 071_customers (client_first_name, client_last_name, client_identification, client_email, client_phone_number, client_password) 
                    VALUES ('$firstName', '$lastName', '$identification', '$email', '$phoneNumber', '$password')";

    if (mysqli_query($conn, $customerSql)) {
        
        $customerId = mysqli_insert_id($conn); 
        
        $userOnline = $firstName; 
        $userSql = "INSERT INTO 071_users (user_online, user_mail, user_password, user_role, client_id) 
                    VALUES ('$userOnline', '$email', '$password', 'customer', '$customerId')";

        if (mysqli_query($conn, $userSql)) {
            showPopup("User and customer created successfully!", 'success', '/student071/dwes/index.php'); 
        } else {
            showPopup("Error inserting user into users table: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']); 
        }
        
    } else {
        showPopup("Error inserting customer into 071_customers table: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']); 
    }

    mysqli_close($conn);

} else {
    showPopup("Invalid request method.", 'error', $_SERVER['HTTP_REFERER']); 
}
?>

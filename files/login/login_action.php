<?php
session_start(); 

$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
include($root . '/student071/dwes/files/common-files/header.php'); 

$log_file = $root . '/student071/dwes/files/logs/login_register.txt';
$handle = fopen($log_file,'a'); // Se abre el archivo en modo append para agregar nuevas entradas

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['u-email']);  
    $password = $_POST['u-password'];  

    $query = "SELECT user_id, client_id, user_online, user_mail, user_password, user_role FROM 071_users WHERE user_mail = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password === $user['user_password']) {  
            $_SESSION['user_id'] = $user['user_id'];  
            $_SESSION['client_id'] = $user['client_id']; 
            $_SESSION['user_mail'] = $user['user_mail'];  
            $_SESSION['user_online'] = $user['user_online'];  
            $_SESSION['role'] = $user['user_role'];  

            setcookie('user_id', $user['user_id'], 0, '/');  
            setcookie('client_id', $user['client_id'], 0, '/'); 
            setcookie('user_mail', $user['user_mail'], 0, '/');  
            setcookie('user_online', $user['user_online'], 0, '/');  
            setcookie('role', $user['user_role'], 0, '/');  

            // Registrar en el log
            fwrite($handle, "[" . date('Y-m-d H:i:s') . "], Email = " . $email . ", User_ID = " . $user['user_id'] . "\n");

            header("Location: /student071/dwes/index.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Incorrect password.";
            header("Location: /student071/dwes/files/login/login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "No account found with that email.";
        header("Location: /student071/dwes/files/login/login.php");
        exit();
    }
}
?>

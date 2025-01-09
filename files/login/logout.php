<?php
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'N/A';
$user_mail = isset($_SESSION['user_mail']) ? $_SESSION['user_mail'] : 'N/A';

session_unset(); 
session_destroy(); 

$root = $_SERVER['DOCUMENT_ROOT'];
$log_file = $root . '/student071/dwes/files/logs/logout_register.txt';
$handle = fopen($log_file, 'a');

fwrite($handle, "[" . date('Y-m-d H:i:s') . "]User_ID = " . $user_id . ", Email = " . $user_mail . "\n");

header("Location: /student071/dwes/index.php"); 
exit();
?>

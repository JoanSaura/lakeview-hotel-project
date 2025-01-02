<?php
session_start();
session_unset(); 
session_destroy(); 
header("Location: /student071/dwes/index.php"); 
exit();
?>

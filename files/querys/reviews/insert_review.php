<?php
session_start(); 

$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
include($root . '/student071/dwes/files/functions/showPopUp.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: /student071/dwes/files/login/login.php");
    exit();
}

$review_text  = isset($_POST['review_text'])  ? mysqli_real_escape_string($conn, $_POST['review_text'])  : '';
$review_score = isset($_POST['review_score']) ? intval($_POST['review_score']) : 0;
$review_title = isset($_POST['review_title']) ? mysqli_real_escape_string($conn, $_POST['review_title']) : '';
$user_id      = $_SESSION['user_id'];

$query = "
    INSERT INTO 071_reviews (user_id, customer_review, customer_score, inserted_on, accepted,review_title,reviewed)
    VALUES ($user_id, '$review_text', '$review_score', CURDATE(), 0, '$review_title',0)
";

if (mysqli_query($conn, $query)) {
    showPopup("Review submitted successfully!", 'success', '/student071/dwes/index.php');
    exit();
} else {
    showPopup("Error inserting review: " . mysqli_error($conn), 'error', $_SERVER['HTTP_REFERER']);
    exit();
}

mysqli_close($conn);
?>

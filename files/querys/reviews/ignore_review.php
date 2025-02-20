<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['review_id'])) {
    $review_id = intval($_GET['review_id']);
    
    $sql = "UPDATE 071_reviews SET accepted = 0, reviewed = 1 WHERE review_id = $review_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: /student071/dwes/files/forms/reviews/review_control_panel.php");
        exit();
    } else {
        echo "Error updating review: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method or missing parameters.";
}

mysqli_close($conn);
?>

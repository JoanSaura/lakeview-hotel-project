<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['review_id']) && isset($_GET['action'])) {
    $review_id = intval($_GET['review_id']);
    $action = $_GET['action'];

    if ($action === 'accept') {
        $sql = "UPDATE 071_reviews SET accepted = 1 WHERE review_id = $review_id";
    } elseif ($action === 'reject') {
        $sql = "UPDATE 071_reviews SET accepted = 0 WHERE review_id = $review_id";
    } else {
        die("Invalid action.");
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: /student071/dwes/files/forms/review_control_panel.php");
        exit();
    } else {
        echo "Error updating review: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method or missing parameters.";
}

mysqli_close($conn);
?>

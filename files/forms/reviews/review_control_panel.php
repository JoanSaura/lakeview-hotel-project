<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
include($root . '/student071/dwes/files/functions/displayStars.php');
include($root . '/student071/dwes/files/common-files/header.php'); 
?>

<div id="review-control-panel">
    <h1>Review Control Panel</h1>
    
    <?php
    $query = "
        SELECT r.review_id, r.customer_review, r.customer_score, r.inserted_on,r.review_title, u.user_online 
        FROM 071_reviews r 
        JOIN 071_users u ON r.user_id = u.user_id 
        WHERE r.accepted = 0 
        ORDER BY r.inserted_on DESC
    ";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($review = mysqli_fetch_assoc($result)) {
            ?>
            <div class="review-card">
            <h3><?php echo htmlspecialchars($review['user_online']); ?> - <?php echo displayStars($review['customer_score']); ?></h3>
            <h5><?php echo htmlspecialchars($review['review_title']); ?></h5>
                <p><?php echo htmlspecialchars($review['customer_review']); ?></p>
                <small>Posted on: <?php echo htmlspecialchars($review['inserted_on']); ?></small>
                <div class="review-actions">
                    <a href="/student071/dwes/files/querys/reviews/update_review_status.php?review_id=<?php echo $review['review_id']; ?>&action=accept" class="accept-button">Accept</a>
                    <a href="/student071/dwes/files/querys/reviews/update_review_status.php?review_id=<?php echo $review['review_id']; ?>&action=reject" class="reject-button">Reject</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No pending reviews found.</p>";
    }
    ?>
</div>

<?php 
include($root . '/student071/dwes/files/common-files/footer.php'); 
?>

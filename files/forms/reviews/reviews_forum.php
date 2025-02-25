<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
include($root . '/student071/dwes/files/functions/displayStars.php');
include($root . '/student071/dwes/files/common-files/header.php'); 
?>

<div id="form-coments">
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <div class="admin-control">
            <a class="admin-link" href="/student071/dwes/files/forms/reviews/review_control_panel.php" class="admin-button">Review Control Panel</a>
        </div>
    <?php endif; ?>

    <h2>Customer Reviews</h2>
    <div id="reviews-list">
        <?php 
        $query = "SELECT r.review_id, r.customer_review, r.customer_score, r.inserted_on, r.review_title, u.user_online 
                  FROM 071_reviews r 
                  JOIN 071_users u ON r.user_id = u.user_id 
                  WHERE r.accepted = 1 AND r.reviewed = 1 
                  ORDER BY r.inserted_on DESC";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while($review = mysqli_fetch_assoc($result)) {
                ?>
                <div class="review-card">
                <h3><?php echo htmlspecialchars($review['user_online']); ?> - <?php echo displayStars($review['customer_score']); ?></h3>
                <h4><?php echo htmlspecialchars($review['review_title']); ?></h4>
                    <p><?php echo htmlspecialchars($review['customer_review']); ?></p>
                    <small>Posted on: <?php echo htmlspecialchars($review['inserted_on']); ?></small>
                </div>
                <?php
            }
        } else {
            echo "<p>No reviews available.</p>";
        }
        ?>
    </div>
</div>

<h2>Leave a Review</h2>
<form class="review-form" action="/student071/dwes/files/querys/reviews/insert_review.php" method="POST">
    <label for="review-title">Review Title</label>
    <input type="text" name="review_title" id="review-title" placeholder="Enter review title" required maxlength="50">

    <label for="review-text">Your Review</label>
    <textarea name="review_text" id="review-text" placeholder="Write your review here..." required maxlength="500"></textarea>

    <label>Rating</label>
    <div id="star-rating">
        <i class="fa fa-star-o star" data-value="1"></i>
        <i class="fa fa-star-o star" data-value="2"></i>
        <i class="fa fa-star-o star" data-value="3"></i>
        <i class="fa fa-star-o star" data-value="4"></i>
        <i class="fa fa-star-o star" data-value="5"></i>
    </div>
    <input type="hidden" name="review_score" id="review-score" value="0" required>

    <button type="submit">Submit Review</button>
</form>

<?php 
include($root . '/student071/dwes/files/common-files/footer.php'); 
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll("#star-rating .star");
    const ratingInput = document.getElementById("review-score");
    
    stars.forEach(function(star) {
        star.addEventListener("click", function() {
            const rating = parseInt(this.getAttribute("data-value"));
            ratingInput.value = rating;
            stars.forEach(function(s) {
                if (parseInt(s.getAttribute("data-value")) <= rating) {
                    s.classList.remove("fa-star-o");
                    s.classList.add("fa-star", "gold");
                } else {
                    s.classList.remove("fa-star", "gold");
                    s.classList.add("fa-star-o");
                }
            });
        });
    });
});
</script>

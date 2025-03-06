<?php
function displayApprovedReviews() {
    $root = $_SERVER['DOCUMENT_ROOT'];
    include $root . '/student071/dwes/files/common-files/db_connection.php';
    include $root . '/student071/dwes/files/functions/displayStars.php'; 

    $query = "
        SELECT r.review_id, r.customer_review, r.customer_score, r.inserted_on, r.review_title, u.user_online 
        FROM 071_reviews r 
        JOIN 071_users u ON r.user_id = u.user_id 
        WHERE r.accepted = 1 AND r.reviewed = 1
        ORDER BY r.inserted_on DESC
    ";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<div id="review-carousel" class="carousel-container">';
        echo '<h1>Our costumers Reviews</h1>';
        echo '<div class="carousel-wrapper">';

        while ($review = mysqli_fetch_assoc($result)) {
            echo '<div class="review-slide">';
            echo '<div class="review-card">';
            echo '<div class="review-header">';
            echo '<h3>' . htmlspecialchars($review['user_online']) . '</h3>';
            echo '<small>' . htmlspecialchars($review['inserted_on']) . '</small>';
            echo '</div>';
            echo '<h4>' . htmlspecialchars($review['review_title']) . '</h4>';
            echo '<div class="review-stars">' . displayStars($review['customer_score']) . '</div>';
            echo '<p class="review-text">' . htmlspecialchars($review['customer_review']) . '</p>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '<button class="prev" onclick="moveSlide(-1)">&#10094;</button>';
        echo '<button class="next" onclick="moveSlide(1)">&#10095;</button>';
        echo '</div>';
    } else {
        echo "<p>No approved reviews found.</p>";
    }

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

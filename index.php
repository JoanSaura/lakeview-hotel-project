<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include $root . '/student071/dwes/files/common-files/header.php';
include $root . '/student071/dwes/files/functions/displayAprovedReviews.php';
include $root . '/student071/dwes/files/functions/showWeather.php';
?>

<div id="home-container">

    <div id="weather-container">
        <?php displayWeather(); ?>
    </div>

    <div id="home">
        <div class="home-header">
            <h3>Welcome to Lakeview Hotel</h3>
        </div>
        <div class="slider">
            <img src="/student071/dwes/img/1.jpg" alt="Image 1" class="active">
            <img src="/student071/dwes/img/2.jpg" alt="Image 2">
            <img src="/student071/dwes/img/3.jpg" alt="Image 3">
        </div>
    </div>

    <div class="home-section">
        <?php displayApprovedReviews(); ?>
    </div>

</div>

<script src="/student071/dwes/js/home_slider.js"></script>
<script src="/student071/dwes/js/review_slider.js"></script>

<?php include $root . '/student071/dwes/files/common-files/footer.php'; ?>

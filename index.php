<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include $root . '/student071/dwes/files/common-files/header.php';
include $root . '/student071/dwes/files/functions/displayAprovedReviews.php';
include $root . '/student071/dwes/files/functions/showWeather.php';
?>

<div id="weather-container">
    <?php displayWeatherCard(); ?>
</div>


<div id="home-container">
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

    <div id="personal-assistant">
    <div id="assistant-header">🛎️ Personal Assistant</div>
    <div id="assistant-body">
        <div id="assistant-menu">
            <button onclick="loadContent('reservations')">📅 Reservations</button>
            <button onclick="loadContent('reviews')">📝 Reviews</button>
            <button onclick="loadContent('services')">🛍️ Purchased Services</button>
        </div>
        <div id="assistant-content">
            <p>Select an option to view details...</p>
        </div>
    </div>
</div>







</div>

<script src="/student071/dwes/js/home_slider.js"></script>
<script src="/student071/dwes/js/review_slider.js"></script>
<script src="/student071/dwes/js/chatbot.js"></script>

<?php include $root . '/student071/dwes/files/common-files/footer.php'; ?>
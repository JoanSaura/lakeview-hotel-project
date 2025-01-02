<?php 
$root = $_SERVER['DOCUMENT_ROOT']; 
include($root . '/student071/dwes/files/common-files/header.php'); 
?>

<div class="services-container">
    <div class="service" id="gym">
        <div class="service-info">
            <h2>GYM</h2>
            <p>Open hours: 10:00 - 20:00</p>
            <p>Price: $20</p>
        </div>
    </div>
    <div class="service" id="spa">
        <div class="service-info">
            <h2>Spa</h2>
            <p>Open hours: 16:00 - 01:00</p>
            <p>Price: $20</p>
        </div>
    </div>
    <div class="service" id="restaurant">
        <div class="service-info">
            <h2>Restaurant</h2>
            <p>Open hours: 8:00 - 23:00</p>
            <p>Breakfast: $8.00</p>
            <p>Meal: $16.00</p>
            <p>Dinner: $16.00</p>
            <p>Extras:</p>
            <ul>
                <li>Deserts: $2.00</li>
                <li>High Quality Wine: $15.00</li>
                <li>Terrace: $3.00</li>
            </ul>
        </div>
    </div>
</div>




<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>

<?php
session_start(); 
$root = $_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7f53f0147c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="/student071/dwes/img/icons/icon.ico">
    <link rel="stylesheet" href="/student071/dwes/css/style.css">
    <link rel="stylesheet" href="/student071/dwes/css/manuals.css" />
    <link rel="stylesheet" href="/student071/dwes/css/forms.css">
    <link rel="stylesheet" href="/student071/dwes/css/reviews.css">
    <link rel="stylesheet" href="/stundent071/dwes/css/weather.css">
    <title>Lakeview Hotel</title>
    <script>
        function alertForLogin() {
            alert("You must be logged in to make a reservation.");
            window.location.href = "/student071/dwes/files/login/login.php";
        }
    </script>
    <script src="/student071/dwes/js/script.js"></script>
</head>

<body>
    <div id="top-container">
        <div id="head">
            <a href="/student071/dwes/index.php">
                <img src="/student071/dwes/img/LogoText.png" alt="Lakeview Hotel">
            </a>
            <div class="user-menu">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="link user-login">
                        <i class="fa-solid fa-user"></i>
                        <p><?php echo "Hello, " . htmlspecialchars(isset($_SESSION['user_online']) ? $_SESSION['user_online'] : 'Guest'); ?></p>  
                    </div>
                    <div class="link user-login">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <a href="/student071/dwes/files/login/logout.php">Logout</a>
                    </div>
                <?php else: ?>
                    <div class="link">
                        <i class="fa-solid fa-user"></i>
                        <a href="/student071/dwes/files/login/login.php">Login</a>
                    </div>
                    <div class="link">
                        <i class="fa-solid fa-user-plus"></i>
                        <a href="/student071/dwes/files/register.php">Register</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div id="head-menu">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/student071/dwes/files/forms/reservations/insert_reservation_forms.php">Book a room</a>
            <?php else: ?>
                <a href="#" onclick="alertForLogin()">Book a room</a>
            <?php endif; ?>
            <a href="/student071/dwes/files/about_us.php">About Us</a>
            <a href="/student071/dwes/files/services.php">Services</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/student071/dwes/files/admin_page.php">Admin Page</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
                
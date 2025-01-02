<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/header.php');

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']); 
?>

<section id="container-form">
    <form class="login-form" action="/student071/dwes/files/login/login_action.php" method="POST">
        <h3>Login User</h3>

        <label for="email">Mail</label>
        <input type="email" name="u-email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="u-password" id="password" required>

        <?php if ($error_message): ?>
            <p class="error-display"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Login">
        </div>
    </form>
</section>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?> 

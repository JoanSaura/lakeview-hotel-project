<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/header.php');

$today = date('Y-m-d'); 
?>

<section id="container-form">
    <form class="login-form" action="/student071/dwes/files/querys/reservations/show_available_rooms.php" method="POST">
        <h3>Make a Reservation</h3>

        <input type="hidden" name="client-id" value="<?php echo htmlspecialchars($_SESSION['client_id']); ?>">

        <label for="date-in">Date In</label>
        <input type="date" name="date-in" id="date-in" min="<?php echo $today; ?>" required>

        <label for="date-out">Date Out</label>
        <input type="date" name="date-out" id="date-out" min="<?php echo $today; ?>" required>

        <label for="num-persons">Number of Persons</label>
        <input type="number" name="num-persons" id="num-persons" min="1" required>

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Reserve">
        </div>
    </form>
</section>


<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>

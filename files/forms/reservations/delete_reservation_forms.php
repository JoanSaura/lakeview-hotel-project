<?php 
$root = $_SERVER['DOCUMENT_ROOT']; 
include($root . '/student071/dwes/files/common-files/db_connection.php');

$sqlReservations = "SELECT r.reservation_id, c.client_first_name, c.client_last_name, rm.room_number, r.date_in, r.date_out 
                    FROM 071_reservations r
                    JOIN 071_customers c ON r.client_id = c.client_id
                    JOIN 071_rooms rm ON r.room_id = rm.room_id;";
$resultReservations = mysqli_query($conn, $sqlReservations);

if (!$resultReservations) {
    echo "Error en la consulta de reservas: " . mysqli_error($conn);
    exit();
}
?>

<?php include($root . '/student071/dwes/files/common-files/header.php')?> 

<section id="container-form">
    <form class="login-form" id="delete-reservation-form" action="/student071/dwes/files/querys/reservations/delete_reservation.php" method="POST"> 
        <h3>Delete a Reservation</h3>

        <label for="reservation-select">Select Reservation to Delete</label>
        <select name="reservation-id" id="reservation-select" required>
            <option value="">Choose a reservation</option>
            <?php while ($reservation = mysqli_fetch_assoc($resultReservations)) { ?>
                <option value="<?php echo intval($reservation['reservation_id']); ?>">
                    <?php echo "Reservation #" . htmlspecialchars($reservation['reservation_id']) . " - " . 
                                htmlspecialchars($reservation['client_first_name']) . " " . 
                                htmlspecialchars($reservation['client_last_name']) . " - Room " . 
                                htmlspecialchars($reservation['room_number']) . " - From " . 
                                htmlspecialchars($reservation['date_in']) . " to " . 
                                htmlspecialchars($reservation['date_out']); ?>
                </option>
            <?php } ?>
        </select>

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Delete Reservation">
        </div>
    </form>
</section>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>  

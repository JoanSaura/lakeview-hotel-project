<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');

$sqlReservation = "SELECT r.reservation_id, c.client_id, c.client_first_name, c.client_last_name,
                   rm.room_id, rm.room_number, rt.room_type_price_per_day, rt.room_type_name, 
                   r.date_in, r.date_out, r.reservation_state 
                   FROM 071_reservations r
                   JOIN 071_customers c ON r.client_id = c.client_id
                   JOIN 071_rooms rm ON r.room_id = rm.room_id
                   JOIN 071_room_type rt ON rm.room_type_id = rt.room_type_id;";
$resultReservation = mysqli_query($conn, $sqlReservation);

if (!$resultReservation) {
    echo "Error en la consulta de reservas: " . mysqli_error($conn);
    exit();
}

$sqlCustomers = "SELECT client_id, client_first_name, client_last_name FROM 071_customers;";
$resultCustomers = mysqli_query($conn, $sqlCustomers);

if (!$resultCustomers) {
    echo "Error en la consulta de clientes: " . mysqli_error($conn);
    exit();
}

$sqlRooms = "SELECT rm.room_id, rm.room_number, rt.room_type_name, rt.room_type_price_per_day 
             FROM 071_rooms rm 
             JOIN 071_room_type rt ON rm.room_type_id = rt.room_type_id;";
$resultRooms = mysqli_query($conn, $sqlRooms);

if (!$resultRooms) {
    echo "Error en la consulta de habitaciones: " . mysqli_error($conn);
    exit();
}

$today = date('Y-m-d'); 
include($root . '/student071/dwes/files/common-files/header.php');
?>

<div id="middle-title">
    <h1>Edit a Reservation</h1>
</div>

<section id="container-form">
    <form class="login-form" id="update-reservation-form" action="/student071/dwes/files/querys/reservations/update_reservations.php" method="POST">
        <label for="reservation-select">Select Reservation to Update</label>
        <select name="reservation-id" id="reservation-select" required onchange="populateReservationDetails(this.value)">
            <option value="">Choose a Reservation</option>
            <?php while ($reservation = mysqli_fetch_assoc($resultReservation)) { ?>
                <option value="<?php echo intval($reservation['reservation_id']); ?>"
                    data-client-id="<?php echo intval($reservation['client_id']); ?>"
                    data-first-name="<?php echo htmlspecialchars($reservation['client_first_name']); ?>"
                    data-last-name="<?php echo htmlspecialchars($reservation['client_last_name']); ?>"
                    data-room-id="<?php echo intval($reservation['room_id']); ?>"
                    data-room-number="<?php echo htmlspecialchars($reservation['room_number']); ?>"
                    data-room-price="<?php echo htmlspecialchars($reservation['room_type_price_per_day']); ?>"
                    data-room-type="<?php echo htmlspecialchars($reservation['room_type_name']); ?>"
                    data-date-in="<?php echo htmlspecialchars($reservation['date_in']); ?>"
                    data-date-out="<?php echo htmlspecialchars($reservation['date_out']); ?>"
                    data-state="<?php echo htmlspecialchars($reservation['reservation_state']); ?>">
                    Reservation #<?php echo htmlspecialchars($reservation['reservation_id']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="client-select">Client</label>
        <select name="client-id" id="client-select" required>
            <option value="">Choose a Client</option>
            <?php while ($customer = mysqli_fetch_assoc($resultCustomers)) { ?>
                <option value="<?php echo intval($customer['client_id']); ?>">
                    <?php echo htmlspecialchars($customer['client_first_name'] . ' ' . $customer['client_last_name']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="room-details">Room Details</label>
        <select name="room-id" id="room-details" required onchange="updateRoomPrice(this)">
            <option value="">Choose a Room</option>
            <?php while ($room = mysqli_fetch_assoc($resultRooms)) { ?>
                <option value="<?php echo intval($room['room_id']); ?>"
                    data-room-number="<?php echo htmlspecialchars($room['room_number']); ?>"
                    data-room-price="<?php echo htmlspecialchars($room['room_type_price_per_day']); ?>"
                    data-room-type="<?php echo htmlspecialchars($room['room_type_name']); ?>">
                    Room <?php echo htmlspecialchars($room['room_number']) . " - " . htmlspecialchars($room['room_type_name']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="date-in">Date In</label>
        <input type="date" name="date-in" id="date-in" min="<?php echo $today; ?>" required>

        <label for="date-out">Date Out</label>
        <input type="date" name="date-out" id="date-out" min="<?php echo $today; ?>" required>

        <label for="reservation-price">Price per Day</label>
        <input type="text" id="reservation-price" name="reservation-price" disabled>

        <label for="state">Reservation State</label>
        <select name="reservation-state" id="state" required>
            <option value="Booked">Booked</option>
            <option value="Cancelled">Cancelled</option>
            <option value="Check-In">Check-In</option>
            <option value="Check-Out">Check-Out</option>
        </select>

        <input type="hidden" name="reservation-id" id="reservation-id">

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Update Reservation">
        </div>
    </form>
</section>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>

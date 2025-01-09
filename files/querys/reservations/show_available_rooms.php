<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/functions/RoomImages.php');



$rooms = [];
$error_message = '';
$no_rooms_available = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = (int)$_POST['client-id'];
    $date_in = mysqli_real_escape_string($conn, $_POST['date-in']);
    $date_out = mysqli_real_escape_string($conn, $_POST['date-out']);
    $num_persons = (int)$_POST['num-persons'];

    if ($date_in >= $date_out) {
        $error_message = "La fecha de salida debe ser mayor que la fecha de entrada.";
    } else {
        $query = "
            SELECT r.room_id, r.room_number, rt.room_type_name AS room_category, rt.room_type_price_per_day, rt.room_type_capacity, rt.room_type_id
            FROM 071_rooms r
            JOIN 071_room_type rt ON r.room_type_id = rt.room_type_id
            WHERE r.room_id NOT IN (
                SELECT room_id
                FROM 071_reservations
                WHERE (date_in < '$date_out' AND date_out > '$date_in')
            )
            AND rt.room_type_capacity >= $num_persons
            GROUP BY rt.room_type_name
        ";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
        } else {
            $no_rooms_available = true;
        }

        mysqli_close($conn);
    }
}
?>

<section id="available-rooms-section">
    <?php if ($error_message): ?>
        <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
        
    <?php if (!empty($rooms)): ?>
        <h3>Available Rooms</h3>
        <div class="available-rooms">
            <?php $room_count = 1; ?>
            <?php foreach ($rooms as $room): ?>
                <div class="room">
                    <img src="<?php echo getRoomImage($room['room_type_id']); ?>" alt="Room Image" class="room_image">
                    <h1>Room <?php echo $room_count++; ?></h1> 
                    <p>Type: <?php echo htmlspecialchars($room['room_category']); ?></p>
                    <p>Capacity: <?php echo htmlspecialchars($room['room_type_capacity']); ?> persons</p>
                    <p>Price per Day: $<?php echo htmlspecialchars($room['room_type_price_per_day']); ?></p>
                    
                    <form action="/student071/dwes/files/querys/reservations/insert_reservation.php" method="POST">
                        <input type="hidden" name="client-id" value="<?php echo htmlspecialchars($client_id); ?>">
                        <input type="hidden" name="room-id" value="<?php echo htmlspecialchars($room['room_id']); ?>">
                        <input type="hidden" name="room-type-id" value="<?php echo htmlspecialchars($room['room_type_id']); ?>">
                        <input type="hidden" name="date-in" value="<?php echo htmlspecialchars($date_in); ?>">
                        <input type="hidden" name="date-out" value="<?php echo htmlspecialchars($date_out); ?>">
                        <input type="hidden" name="price-per-day" value="<?php echo htmlspecialchars($room['room_type_price_per_day']); ?>">
                        <input type="hidden" name="num-persons" value="<?php echo htmlspecialchars($num_persons); ?>">
                        <button type="submit" name="book-room">Book</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($no_rooms_available): ?>
        <p>No rooms are available for the selected dates and number of persons.</p>
    <?php endif; ?>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/footer.php'); ?>

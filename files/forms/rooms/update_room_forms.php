<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');

$roomNumber = isset($_GET['room-number']) ? intval($_GET['room-number']) : 0;

$roomDetails = null;
if ($roomNumber > 0) {
    $sqlRoomDetails = "SELECT r.room_number, r.room_type_id, rt.room_type_name, rt.room_type_price_per_day, rt.room_type_description
                       FROM 071_rooms r
                       JOIN 071_room_type rt ON r.room_type_id = rt.room_type_id
                       WHERE r.room_number = $roomNumber"; 

    $resultRoomDetails = mysqli_query($conn, $sqlRoomDetails);

    if (!$resultRoomDetails) {
        echo "Error fetching room details: " . mysqli_error($conn);
        exit();
    }

    $roomDetails = mysqli_fetch_assoc($resultRoomDetails);

    if (!$roomDetails) {
        echo "Room not found.";
        exit();
    }
}

$sqlRoomTypes = "SELECT room_type_id, room_type_name, room_type_price_per_day, room_type_description FROM 071_room_type";
$resultRoomTypes = mysqli_query($conn, $sqlRoomTypes);

if (!$resultRoomTypes) {
    echo "Error fetching room types: " . mysqli_error($conn);
    exit();
}

?>

<?php include($root . '/student071/dwes/files/common-files/header.php'); ?>

<section id="container-form">
    <form class="login-form" id="update-room-form" action="/student071/dwes/files/querys/rooms/update_rooms.php" method="POST">
        <h3>Update Room</h3>

        <label for="room-select">Select Room to Update</label>
        <select name="room-number" id="room-select" required onchange="populateRoomDetails(this.value)">
            <option value="">Choose a room</option>
            <?php 
            $resultRooms = mysqli_query($conn, "SELECT r.room_number, r.room_type_id, rt.room_type_name, rt.room_type_price_per_day, rt.room_type_description 
                                               FROM 071_rooms r 
                                               JOIN 071_room_type rt ON r.room_type_id = rt.room_type_id");
            while ($room = mysqli_fetch_assoc($resultRooms)) { ?>
                <option value="<?php echo intval($room['room_number']); ?>" 
                        data-type-id="<?php echo intval($room['room_type_id']); ?>" 
                        data-type-name="<?php echo htmlspecialchars($room['room_type_name']); ?>" 
                        data-price="<?php echo htmlspecialchars($room['room_type_price_per_day']); ?>"
                        data-description="<?php echo htmlspecialchars($room['room_type_description']); ?>"
                        <?php echo ($roomNumber && $room['room_number'] == $roomDetails['room_number']) ? 'selected' : ''; ?>>
                    Room <?php echo htmlspecialchars($room['room_number']); ?> - <?php echo htmlspecialchars($room['room_type_name']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="room-number-input">Room Number</label>
        <input type="number" name="room-number-input" id="room-number-input" value="<?php echo ($roomDetails) ? htmlspecialchars($roomDetails['room_number']) : ''; ?>" required>

        <label for="room-type">Room Type</label>
        <select name="room-type" id="room-type" required>
            <?php while ($roomType = mysqli_fetch_assoc($resultRoomTypes)) { ?>
                <option value="<?php echo intval($roomType['room_type_id']); ?>" 
                        <?php echo ($roomDetails && $roomType['room_type_id'] == $roomDetails['room_type_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($roomType['room_type_name']); ?> - $<?php echo htmlspecialchars($roomType['room_type_price_per_day']); ?> per day
                </option>
            <?php } ?>
        </select>

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Update Room">
        </div>
    </form>
</section>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>

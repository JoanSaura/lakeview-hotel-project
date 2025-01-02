<?php 
$root = $_SERVER['DOCUMENT_ROOT']; 
include($root . '/student071/dwes/files/common-files/db_connection.php');

// Capturamos el room_number de la URL
$room_number = isset($_GET['room-number']) ? intval($_GET['room-number']) : 0;

$sqlRooms = "SELECT r.room_number, rt.room_type_name 
             FROM 071_rooms r 
             JOIN 071_room_type rt ON r.room_type_id = rt.room_type_id;";
$resultRooms = mysqli_query($conn, $sqlRooms);

if (!$resultRooms) {
    echo "Error en la consulta: " . mysqli_error($conn);
    exit();
}
?>

<?php include($root . '/student071/dwes/files/common-files/header.php')?>

<section id="container-form">
    <form class="login-form" id="delete-room-form" action="/student071/dwes/files/querys/rooms/delete_rooms.php" method="POST"> 
        <h3>Delete a Room</h3>

        <label for="room-select">Select Room to Delete</label>
        <select name="room-number" id="room-select" required>
            <option value="">Choose a room</option>
            <?php while ($room = mysqli_fetch_assoc($resultRooms)) { ?>
                <option value="<?php echo intval($room['room_number']); ?>"
                    <?php echo ($room['room_number'] == $room_number) ? 'selected' : ''; ?>>
                    Room <?php echo htmlspecialchars($room['room_number']); ?> - <?php echo htmlspecialchars($room['room_type_name']); ?>
                </option>
            <?php } ?>
        </select>

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Delete Room">
        </div>
    </form>
</section>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>

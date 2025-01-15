<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$rooms = include($root . '/student071/dwes/files/querys/rooms/select_rooms.php');
?>
<?php include($root . '/student071/dwes/files/common-files/header.php') ?>

<div id="middle-title">
    <h1>Hotel Rooms</h1>
    <section id="searcher">
        <h4>Searcher</h4>
        <label for="room_number">Room Number</label>
        <input type="number" name="room_number" placeholder="Enter the room number" id="RoomNumberSearcher" onkeyup="searchFullName(this.value)">
    </section>
</div>

<div id="info-display">
    <div id="room-list">
        <?php if (!empty($rooms)) { ?>
            <?php foreach ($rooms as $room) { ?>
                <div class="room-card">
                    <div class="name-display">
                        <h4><?php echo htmlspecialchars($room['room_number']); ?></h4>
                    </div>
                    <p><strong>Room Type:</strong> <?php echo htmlspecialchars($room['room_type_name']); ?></p>
                    <p><strong>Price per Day:</strong> <?php echo htmlspecialchars($room['room_price_per_day']); ?></p>
                    <p><strong>Room Status:</strong> <?php echo htmlspecialchars($room['room_status']); ?></p>

                    <a href="/student071/dwes/files/forms/rooms/update_room_forms.php?room-number=<?php echo $room['room_number']; ?>" class="edit-button">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                
                    <a href="/student071/dwes/files/forms/rooms/delete_room_forms.php?room-number=<?php echo $room['room_number']; ?>" class="delete-button">
                        <i class="fa-solid fa-trash"></i>
                    </a>

                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No rooms found in the database.</p>
        <?php } ?>
    </div>
</div>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>
<script>
    function searchRoomNumber(RoomNumber) {
        const RoomCard = document.querySelectorAll('#room-list');
        const searchTerm = RoomNumber.trim();
        const searcher = document.getElementById('RoomNumberSearcher')

        RoomCard.forEach(card => {
            const RoomDetails = card.querySelector('.name-display').textContent();
            if (RoomDetails.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    searcher.addEventListener('keyup', function() {
        searchRoomNumber(this.value);
    });
</script>
<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$reservations = include($root . '/student071/dwes/files/querys/reservations/select_reservations.php');
?>
<?php include($root . '/student071/dwes/files/common-files/header.php'); ?>

<div id="middle-title">
    <h1>Reservation Details</h1>
</div>

<div id="info-display">
    <div id="reservations-list">
        <?php if (!empty($reservations)) { ?>
            <?php foreach ($reservations as $reservation) { ?>
                <div class="reservation-card">
                    <div class="reservation-details">
                        <div class="name-display">
                            <h4>Room Number: <?php echo htmlspecialchars($reservation['071_room_number']); ?></h4>
                        </div>
                        <p><strong>Room Type:</strong> <?php echo htmlspecialchars($reservation['071_room_type_name']); ?></p>
                        <p><strong>Price per Day:</strong> $<?php echo htmlspecialchars($reservation['071_room_price_per_day']); ?></p>
                    </div>

                    <div class="client-details">
                        <p><strong>Client Name:</strong> <?php echo htmlspecialchars($reservation['071_client_first_name']) . ' ' . htmlspecialchars($reservation['071_client_last_name']); ?></p>
                    </div>

                    <div class="date-details">
                        <p><strong>Date In:</strong> <?php echo htmlspecialchars($reservation['071_date_in']); ?></p>
                        <p><strong>Date Out:</strong> <?php echo htmlspecialchars($reservation['071_date_out']); ?></p>
                        <p><strong>Total Days:</strong> <?php echo htmlspecialchars($reservation['071_total_days']); ?></p>
                        <p><strong>Total Price:</strong> $<?php echo htmlspecialchars($reservation['071_total_price']); ?></p>
                    </div>
                    <a href="generate_pdf.php?reservation_id=<?php echo $reservation['reservation_id']; ?>" class="generate-pdf-button">
                        <button>Generate PDF</button>
                    </a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No reservations found in the database.</p>
        <?php } ?>
    </div>
</div>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>
<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include($root . '/student071/dwes/files/common-files/db_connection.php');
include($root . '/student071/dwes/files/common-files/header.php');

if (!isset($_SESSION['client_id'])) {
    echo "<p style='color: red;'>You must be logged in to make a reservation.</p>";
    include($root . '/student071/dwes/files/common-files/footer.php');
    exit;
}

$client_id = $_SESSION['client_id'];

// Obtener reservas del cliente
$reservations_query = "SELECT reservation_id FROM 071_reservations WHERE client_id = $client_id";
$reservations_result = mysqli_query($conn, $reservations_query);
$reservations = [];

while ($row = mysqli_fetch_assoc($reservations_result)) {
    $reservations[] = $row['reservation_id'];
}

// Obtener servicios disponibles
$services_query = "SELECT * FROM 071_services";
$services_result = mysqli_query($conn, $services_query);
?>

<form action="/student071/dwes/files/querys/reservations/service/insert_reservation_services.php" method="POST" class="login-form" id="reservation-form">
    <h1>Add a Service Reservation</h1>

    <label for="reservation">Your Reservation</label>
    <?php if (count($reservations) == 1): ?>
        <p>Your reservation ID: <strong><?php echo htmlspecialchars($reservations[0]); ?></strong></p>
        <input type="hidden" name="reservation_id" value="<?php echo $reservations[0]; ?>">
    <?php elseif (count($reservations) > 1): ?>
        <select name="reservation_id" id="reservation" required>
            <option value="">Select your reservation</option>
            <?php foreach ($reservations as $reservation_id): ?>
                <option value="<?php echo htmlspecialchars($reservation_id); ?>">
                    Reservation #<?php echo htmlspecialchars($reservation_id); ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php else: ?>
        <p style="color: red;">You have no active reservations.</p>
        <?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>
        <?php exit; ?>
    <?php endif; ?>

    <label for="service">Service</label>
    <select name="service" id="service" required>
        <option value="">Select a service</option>
        <?php while ($service = mysqli_fetch_assoc($services_result)): ?>
            <option value="<?php echo htmlspecialchars($service['service_id']); ?>">
                <?php echo htmlspecialchars($service['service_name']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="service-date">Date</label>
    <input type="date" name="service-date" id="service-date" required>

    <label for="capacity">Number of People</label>
    <input type="number" name="capacity" id="capacity" min="1" required>

    <label for="free-hours">Available Hours</label>
    <select name="free-hours" id="free-hours" required>
        <option value="">Select a date first</option>
    </select>

    <p id="capacity-warning" style="color: red; display: none;">Not enough capacity available.</p>

    <button type="submit" id="submit-button" disabled>Reserve</button>
</form>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("reservation-form");
    const serviceSelect = document.getElementById("service");
    const dateInput = document.getElementById("service-date");
    const capacityInput = document.getElementById("capacity");
    const hoursSelect = document.getElementById("free-hours");
    const capacityWarning = document.getElementById("capacity-warning");
    const submitButton = document.getElementById("submit-button");

    function fetchAvailableHours() {
        const serviceId = serviceSelect.value;
        const selectedDate = dateInput.value;

        if (!serviceId || !selectedDate) {
            hoursSelect.innerHTML = '<option>Select a date first</option>';
            submitButton.disabled = true;
            return;
        }

        fetch("/student071/dwes/files/querys/reservations/service/get_available_hours.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `service_id=${serviceId}&date=${selectedDate}`
        })
        .then(response => response.json())
        .then(data => {
            hoursSelect.innerHTML = data.hours.length 
                ? data.hours.map(hour => `<option value="${hour.time}" data-capacity="${hour.remaining_capacity}">${hour.time}:00 (Available: ${hour.remaining_capacity})</option>`).join('')
                : '<option>No available hours</option>';

            submitButton.disabled = data.hours.length === 0;
        })
        .catch(() => alert("Error loading available hours."));
    }

    function checkCapacity() {
        const remainingCapacity = parseInt(hoursSelect.selectedOptions[0]?.dataset.capacity || 0);
        submitButton.disabled = capacityInput.value > remainingCapacity;
        capacityWarning.style.display = submitButton.disabled ? "block" : "none";
    }

    serviceSelect.addEventListener("change", fetchAvailableHours);
    dateInput.addEventListener("change", fetchAvailableHours);
    hoursSelect.addEventListener("change", checkCapacity);
    capacityInput.addEventListener("input", checkCapacity);
});
</script>


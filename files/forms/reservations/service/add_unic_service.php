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

    function updateAvailableHours() {
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
            body: new URLSearchParams({ service_id: serviceId, date: selectedDate })
        })
        .then(response => response.json())
        .then(data => {
            hoursSelect.innerHTML = "";
            if (data.hours.length > 0) {
                data.hours.forEach(hour => {
                    let option = document.createElement("option");
                    option.value = hour.time;
                    option.dataset.capacity = hour.remaining_capacity;
                    option.textContent = `${hour.time}:00 (Available: ${hour.remaining_capacity})`;
                    hoursSelect.appendChild(option);
                });
                submitButton.disabled = false;
            } else {
                hoursSelect.innerHTML = '<option>No available hours</option>';
                submitButton.disabled = true;
            }
        })
        .catch(error => {
            console.error("Error fetching available hours:", error);
            alert("Error loading available hours. Please try again.");
        });
    }

    function checkCapacity() {
        const selectedOption = hoursSelect.options[hoursSelect.selectedIndex];
        const remainingCapacity = selectedOption ? parseInt(selectedOption.dataset.capacity) : 0;
        const requestedCapacity = parseInt(capacityInput.value) || 0;

        if (requestedCapacity > remainingCapacity) {
            capacityWarning.style.display = "block";
            submitButton.disabled = true;
        } else {
            capacityWarning.style.display = "none";
            submitButton.disabled = false;
        }
    }

    function validateForm(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            alert("Please complete all required fields correctly.");
        }
    }

    serviceSelect.addEventListener("change", updateAvailableHours);
    dateInput.addEventListener("change", updateAvailableHours);
    hoursSelect.addEventListener("change", checkCapacity);
    capacityInput.addEventListener("input", checkCapacity);
    form.addEventListener("submit", validateForm);
});
</script>

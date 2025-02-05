<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
include($root . '/student071/dwes/files/common-files/header.php');

// Obtener los servicios
$sql = 'SELECT * FROM 071_services';
$result = mysqli_query($conn, $sql);
?>

<form action="/student071/dwes/files/querys/reservations/service/insert_reservation_services.php" method="POST" class="login-form" id="reservation-form">
    <h1>Add a Service Reservation</h1>

    <!-- Selección del servicio -->
    <label for="service">Service</label>
    <select name="service" id="service" required>
        <option value="">Select a service</option>
        <?php 
        while ($service = mysqli_fetch_assoc($result)) {
            echo '<option value="'.htmlspecialchars($service['service_id']).'">'.htmlspecialchars($service['service_name']).'</option>';
        }
        ?>
    </select>

    <!-- Selección de la fecha -->
    <label for="service-date">Date</label>
    <input type="date" name="service-date" id="service-date" required>

    <!-- Cantidad de personas -->
    <label for="capacity">Number of People</label>
    <input type="number" name="capacity" id="capacity" min="1" required>

    <!-- Selección de la hora con capacidad restante -->
    <label for="free-hours">Available Hours</label>
    <select name="free-hours" id="free-hours" required>
        <option value="">Select a date first</option>
    </select>

    <!-- Mensaje de error si el aforo no es suficiente -->
    <p id="capacity-warning" style="color: red; display: none;">Not enough capacity available.</p>

    <button type="submit" id="submit-button" disabled>Reserve</button>
</form>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
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
                submitButton.style.display = "block"; 
            } else {
                hoursSelect.innerHTML = '<option>No available hours</option>';
                submitButton.style.display = "none"; 
            }
        })
        .catch(error => console.error("Error fetching available hours:", error));
    }

    function checkCapacity() {
        const selectedOption = hoursSelect.options[hoursSelect.selectedIndex];
        const remainingCapacity = selectedOption ? parseInt(selectedOption.dataset.capacity) : 0;
        const requestedCapacity = parseInt(capacityInput.value) || 0;

        if (requestedCapacity > remainingCapacity) {
            capacityWarning.style.display = "block";
            submitButton.style.display = "none"; // Ocultar botón si el aforo no es suficiente
        } else {
            capacityWarning.style.display = "none";
            submitButton.style.display = "block"; // Mostrar botón si hay suficiente capacidad
        }
    }

    serviceSelect.addEventListener("change", updateAvailableHours);
    dateInput.addEventListener("change", updateAvailableHours);
    hoursSelect.addEventListener("change", checkCapacity);
    capacityInput.addEventListener("input", checkCapacity);
});
</script>

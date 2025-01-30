<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
include($root . '/student071/dwes/files/common-files/header.php');

// Obtener los servicios
$sql = 'SELECT * FROM 071_services';
$result = mysqli_query($conn, $sql);
?>

<form action="process_reservation.php" method="POST" class="login-form" id="reservation-form">
    <h1>Add a Service Reservation</h1>

    <!-- Selección del servicio -->
    <label for="service">Service</label>
    <select name="service" id="service">
        <option value="">Select a service</option>
        <?php 
        if ($result && mysqli_num_rows($result) > 0) {
            while ($service = mysqli_fetch_assoc($result)) {
        ?>
                <option value="<?php echo htmlspecialchars($service['service_id']); ?>">
                    <?php echo htmlspecialchars($service['service_name']); ?>
                </option>
        <?php 
            }
        } else {
            echo '<option>No services found</option>';
        }
        ?>
    </select>

    <!-- Selección de la fecha -->
    <label for="service-date">Date</label>
    <input type="date" name="service-date" id="service-date">

    <!-- Cantidad de personas -->
    <label for="capacity">Number of People</label>
    <input type="number" name="capacity" id="capacity" min="1" placeholder="Enter number of people">

    <!-- Selección de la hora con capacidad restante -->
    <label for="free-hours">Available Hours</label>
    <select name="free-hours" id="free-hours">
        <option value="">Select a date first</option>
    </select>

    <!-- Mensaje de error si el aforo no es suficiente -->
    <p id="capacity-warning" style="color: red; display: none;">Not enough capacity available.</p>

    <button type="submit" id="submit-button" disabled>Reserve</button>
</form>

<?php 
include($root . '/student071/dwes/files/common-files/footer.php');
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const serviceSelect = document.getElementById("service");
    const dateInput = document.getElementById("service-date");
    const capacityInput = document.getElementById("capacity");
    const hoursSelect = document.getElementById("free-hours");
    const capacityWarning = document.getElementById("capacity-warning");
    const submitButton = document.getElementById("submit-button");

    // Actualiza las horas disponibles
    function updateAvailableHours() {
        const serviceId = serviceSelect.value;
        const selectedDate = dateInput.value;

        if (!serviceId || !selectedDate) {
            hoursSelect.innerHTML = '<option>Select a date first</option>';
            return;
        }

        // Enviar solicitud AJAX POST
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/student071/dwes/files/querys/reservations/service/get_available_hours.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                hoursSelect.innerHTML = "";
                if (data.hours.length > 0) {
                    data.hours.forEach(function(hour) {
                        let option = document.createElement("option");
                        option.value = hour.time;
                        option.dataset.capacity = hour.remaining_capacity;
                        option.textContent = `${hour.time}:00 (Available: ${hour.remaining_capacity})`;
                        hoursSelect.appendChild(option);
                    });
                } else {
                    hoursSelect.innerHTML = '<option>No available hours</option>';
                }
            }
        };

        xhr.send("service_id=" + serviceId + "&date=" + selectedDate);
    }

    // Verificar la capacidad
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

    // Evento para actualizar horas disponibles
    serviceSelect.addEventListener("change", updateAvailableHours);
    dateInput.addEventListener("change", updateAvailableHours);
    hoursSelect.addEventListener("change", checkCapacity);
    capacityInput.addEventListener("input", checkCapacity);
});
</script>

<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $service_id = isset($_POST['service']) ? intval($_POST['service']) : null;
    $date = isset($_POST['service-date']) ? $_POST['service-date'] : null;
    $capacity = isset($_POST['capacity']) ? intval($_POST['capacity']) : 1;
    $time = isset($_POST['free-hours']) ? $_POST['free-hours'] : null;

    if (!$service_id || !$date || !$capacity || !$time) {
        echo json_encode(["error" => "Invalid input data"]);
        exit;
    }

    // Convertir la hora a formato JSON
    $rs_time = json_encode([$time]);

    // Verificar si la columna "standard_price" existe en la tabla 071_services
    $check_column_query = "SHOW COLUMNS FROM 071_services LIKE 'standard_price'";
    $check_column_result = mysqli_query($conn, $check_column_query);

    if (mysqli_num_rows($check_column_result) == 0) {
        echo json_encode(["error" => "Column 'standard_price' does not exist in 071_services"]);
        exit;
    }

    // Obtener el precio del servicio
    $price_query = "SELECT price FROM 071_services WHERE service_id = '$service_id'";
    $price_result = mysqli_query($conn, $price_query);
    $price_data = mysqli_fetch_assoc($price_result);

    $price_data = mysqli_fetch_assoc($price_result);
    
    // Si no se encuentra el precio, enviar error
    if (!$price_data) {
        echo json_encode(["error" => "Service price not found"]);
        exit;
    }

    $unit_price = (int)$price_data['standard_price']; // Aseguramos que el precio sea un int
    $total_price = $unit_price * $capacity;

    // Obtener un nuevo `reservation_id`
    $reservation_id_query = "SELECT COALESCE(MAX(reservation_id), 0) + 1 AS next_id FROM 071_reservation_services";
    $reservation_id_result = mysqli_query($conn, $reservation_id_query);
    $reservation_id_data = mysqli_fetch_assoc($reservation_id_result);
    $reservation_id = $reservation_id_data['next_id'];

    // Insertar la reserva en la base de datos
    $insert_query = "INSERT INTO 071_reservation_services (reservation_id, service_id, quantity, rs_price, rs_date, rs_time, rs_state) 
                     VALUES ('$reservation_id', '$service_id', '$capacity', '$total_price', '$date', '$rs_time', 'Checked')";

    if (mysqli_query($conn, $insert_query)) {
        echo json_encode(["success" => "Reservation added successfully"]);
    } else {
        echo json_encode(["error" => "Database error: " . mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>

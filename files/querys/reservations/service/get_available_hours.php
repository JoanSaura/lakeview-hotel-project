<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = intval($_POST['service_id']);
    $date = $_POST['date'];

    // Obtener el aforo máximo y las horas de apertura del servicio
    $service_query = "SELECT maximum_capacity, open_hours FROM 071_services WHERE service_id = $service_id";
    $service_result = mysqli_query($conn, $service_query);
    $service = mysqli_fetch_assoc($service_result);
    
    if (!$service) {
        echo json_encode(["error" => "Service not found"]);
        exit;
    }

    $max_capacity = intval($service['maximum_capacity']);
    $open_hours = json_decode($service['open_hours'], true);

    // Obtener reservas existentes para ese servicio y fecha
    $reservations_query = "SELECT rs_time, SUM(quantity) as total_reserved FROM 071_reservation_services 
                           WHERE service_id = $service_id AND rs_date = '$date'";
    $reservations_result = mysqli_query($conn, $reservations_query);

    // Construir mapa de reservas
    $reserved_slots = [];
    while ($row = mysqli_fetch_assoc($reservations_result)) {
        $reserved_times = json_decode($row['rs_time'], true); // Decodificar el JSON de horas reservadas
        $reserved_quantity = intval($row['total_reserved']);

        if (is_array($reserved_times)) {
            foreach ($reserved_times as $reserved_time) {
                if (!isset($reserved_slots[$reserved_time])) {
                    $reserved_slots[$reserved_time] = 0;
                }
                $reserved_slots[$reserved_time] += $reserved_quantity;
            }
        }
    }

    // Generar lista de horas con capacidad restante
    $available_hours = [];
    foreach ($open_hours as $hour) {
        $reserved = $reserved_slots[$hour] ?? 0;
        $remaining_capacity = max(0, $max_capacity - $reserved);

        if ($remaining_capacity > 0) {
            $available_hours[] = ["time" => $hour, "remaining_capacity" => $remaining_capacity];
        }
    }

    echo json_encode(["hours" => $available_hours]);
}
?>

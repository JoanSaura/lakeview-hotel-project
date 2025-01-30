<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');

// Obtener los parámetros de la solicitud POST
$service_id = $_POST['service_id'] ?? null;
$date = $_POST['date'] ?? null;

if (!$service_id || !$date) {
    echo json_encode(['hours' => []]);
    exit;
}

// Obtener las horas disponibles para el servicio y la fecha
$sql = "
    SELECT sh.hour, sh.remaining_capacity
    FROM 071_service_hours sh
    WHERE sh.service_id = ? AND sh.date = ?
    ORDER BY sh.hour ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('is', $service_id, $date);
$stmt->execute();
$result = $stmt->get_result();

$hours = [];
while ($row = $result->fetch_assoc()) {
    $hours[] = [
        'time' => $row['hour'],
        'remaining_capacity' => $row['remaining_capacity']
    ];
}

echo json_encode(['hours' => $hours]);
exit;
?>

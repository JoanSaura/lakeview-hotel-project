<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/db_connection.php');

$sql = "SELECT reservation_id FROM 071_reservations WHERE reservation_state = 'Booked' OR reservation_state = 'Check-In'";
$result = mysqli_query($conn, $sql);

$services = [
    'GYM' => [
        'price' => 20.00,
        'quantity' => 1, 
    ],
    'Spa' => [
        'price' => 20.00,
        'quantity' => rand(1, 3), 
    ],
    'Restaurant' => [
        'breakfast' => 8.00,
        'meal' => 16.00,
        'dinner' => 16.00,
        'extras' => [
            'deserts' => 2.00,
            'high_quality_wine' => 15.00,
            'terrace' => 3.00
        ]
    ]
];


while ($row = mysqli_fetch_assoc($result)) {
    $reservation_id = $row['reservation_id'];
    $reservation_extras = [];
    foreach ($services as $service_name => $details) {
        if (rand(0, 1)) { 
            if ($service_name === 'Restaurant') {
                $restaurant_extras = [];
                foreach ($details['extras'] as $extra_name => $extra_price) {
                    if (rand(0, 1)) { 
                        $restaurant_extras[$extra_name] = $extra_price;
                    }
                }
                $reservation_extras[$service_name] = [
                    'breakfast' => $details['breakfast'],
                    'meal' => $details['meal'],
                    'dinner' => $details['dinner'],
                    'extras' => $restaurant_extras
                ];
            } else {
                $reservation_extras[$service_name] = [
                    'price' => $details['price'],
                    'quantity' => $details['quantity']
                ];
            }
        }
    }

    // Convertir la array a formato JSON
    $reservation_extras_json = json_encode($reservation_extras);

    // Actualizar la columna reservation_extras de la tabla
    $update_sql = "UPDATE 071_reservations 
                  SET reservation_extras = '$reservation_extras_json'
                  WHERE reservation_id = $reservation_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "Reservation ID $reservation_id updated successfully with random extras.<br>";
    } else {
        echo "Error updating reservation ID $reservation_id: " . mysqli_error($conn) . "<br>";
    }
}

mysqli_close($conn);
?>

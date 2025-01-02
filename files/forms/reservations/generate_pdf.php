<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root . '/student071/dwes/plugins/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
include($root . '/student071/dwes/files/common-files/db_connection.php');

$reservationId = isset($_GET['reservation_id']) ? intval($_GET['reservation_id']) : 0;

if ($reservationId <= 0) {
    die("Invalid reservation ID.");
}

// Consultar la base de datos para obtener los datos de la reserva
$sql = "
    SELECT 
        r.reservation_id, 
        c.client_first_name, 
        c.client_last_name, 
        rm.room_number, 
        rt.room_type_name, 
        rt.room_type_price_per_day, 
        r.date_in, 
        r.date_out,
        r.reservation_extras,
        DATEDIFF(r.date_out, r.date_in) AS total_days,
        (DATEDIFF(r.date_out, r.date_in) * rt.room_type_price_per_day) AS total_price
    FROM 071_reservations r
    JOIN 071_customers c ON r.client_id = c.client_id
    JOIN 071_rooms rm ON r.room_id = rm.room_id
    JOIN 071_room_type rt ON rm.room_type_id = rt.room_type_id
    WHERE r.reservation_id = $reservationId;
";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Reservation not found.");
}

$reservation = mysqli_fetch_assoc($result);
mysqli_free_result($result);

// Decodificar los extras de la reserva desde JSON
$reservation_extras = json_decode($reservation['reservation_extras'], true);
$total_extras_price = 0;

// Leer el archivo CSS
$css = file_get_contents($root . '/student071/dwes/css/invoice_pdf.css');

// Iniciar el HTML de la factura
$html = "
    <style>
        $css
    </style>

    <div class='invoice-header'>
        <h1>Miracle Hotel</h1>
        <h2>Hotel Reservation Invoice</h2>
    </div>
    <div class='invoice-details'>
        <p><strong>Invoice #: </strong>" . htmlspecialchars($reservation['reservation_id']) . "</p>
        <p><strong>Client: </strong>" . htmlspecialchars($reservation['client_first_name']) . " " . htmlspecialchars($reservation['client_last_name']) . "</p>
        <p><strong>Room: </strong>" . htmlspecialchars($reservation['room_number']) . " - " . htmlspecialchars($reservation['room_type_name']) . "</p>
        <p><strong>Check-in: </strong>" . htmlspecialchars($reservation['date_in']) . "</p>
        <p><strong>Check-out: </strong>" . htmlspecialchars($reservation['date_out']) . "</p>
        <p><strong>Total Days: </strong>" . htmlspecialchars($reservation['total_days']) . "</p>
        <p><strong>Price per Day: </strong>$" . htmlspecialchars($reservation['room_type_price_per_day']) . "</p>
    </div>
";

// Mostrar los extras en la factura si existen
if (!empty($reservation_extras)) {
    $html .= "<div class='extras-section'><h3>Extra Services:</h3><ul>";

    foreach ($reservation_extras as $extra_name => $extra_details) {
        if ($extra_name === "Restaurant") {
            // Manejar específicamente los datos del restaurante
            $restaurant_prices = $extra_details;
            $html .= "<li><strong>Restaurant:</strong><ul>";

            foreach ($restaurant_prices as $key => $value) {
                if ($key === "extras") {
                    $html .= "<li><strong>Extras:</strong><ul>";
                    foreach ($value as $extra_key => $extra_value) {
                        $total_extras_price += $extra_value;
                        $html .= "<li>" . htmlspecialchars($extra_key) . ": $" . htmlspecialchars($extra_value) . "</li>";
                    }
                    $html .= "</ul></li>";
                } else {
                    $total_extras_price += $value;
                    $html .= "<li>" . htmlspecialchars($key) . ": $" . htmlspecialchars($value) . "</li>";
                }
            }
            $html .= "</ul></li>";
        } elseif (isset($extra_details['price']) && isset($extra_details['quantity'])) {
            // Manejar otros servicios con precio y cantidad
            $extra_total = $extra_details['price'] * $extra_details['quantity'];
            $total_extras_price += $extra_total;

            $html .= "<li>
                <strong>" . htmlspecialchars($extra_name) . ":</strong> $" . htmlspecialchars($extra_details['price']) . 
                " x " . htmlspecialchars($extra_details['quantity']) . " = $" . htmlspecialchars($extra_total) . "
            </li>";
        }
    }

    $html .= "</ul></div>";
}

// Calcular el precio total incluyendo los extras
$total_price_with_extras = $reservation['total_price'] + $total_extras_price;

// Mostrar el precio total en la factura
$html .= "
    <div class='invoice-total'>
        <h3>Total Price: $" . htmlspecialchars($reservation['total_price']) . "</h3>
        <h3>Total Extras: $" . htmlspecialchars($total_extras_price) . "</h3>
        <h2>Total Price with Extras: $" . number_format($total_price_with_extras, 2) . "</h2>
    </div>
";

// Inicializar Dompdf
$options = new Options();
$options->set('isPhpEnabled', true);

// Crear el objeto Dompdf
$dompdf = new Dompdf($options);

// Cargar el HTML generado
$dompdf->loadHtml($html);

// Establecer el tamaño de página
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$dompdf->render();

// Descargar o mostrar el PDF
$dompdf->stream("invoice_" . $reservation['reservation_id'] . ".pdf", ["Attachment" => false]); // Cambiar a true para forzar la descarga
?>

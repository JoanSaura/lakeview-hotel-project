<?php
function displayWeatherCard() {
    $root = $_SERVER['DOCUMENT_ROOT'];
    include $root . '/student071/dwes/files/common-files/db_connection.php';

    $sql = "SELECT * FROM `071_weather` ORDER BY api_inserted_on DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $api_data = json_decode($row['api_json'], true);

        if (isset($api_data['WeatherText']) && isset($api_data['Temperature']['Metric']['Value']) && isset($api_data['Temperature']['Metric']['Unit']) && isset($api_data['WeatherIcon'])) {
            $weatherText = htmlspecialchars($api_data['WeatherText']);
            $temperature = htmlspecialchars($api_data['Temperature']['Metric']['Value']);
            $unit = htmlspecialchars($api_data['Temperature']['Metric']['Unit']);
            $icon = str_pad($api_data['WeatherIcon'], 2, '0', STR_PAD_LEFT); // Asegurar formato 2 dígitos

            echo '
            <div class="weather-card">
                <div class="weather-icon">
                    <img src="https://developer.accuweather.com/sites/default/files/' . $icon . '-s.png" alt="Weather Icon">
                </div>
                <div class="weather-info">
                    <h2>' . $weatherText . '</h2>
                    <p class="temperature">' . $temperature . '°' . $unit . '</p>
                </div>
            </div>';
        } else {
            echo "<p>No hay suficientes datos del clima disponibles.</p>";
        }
    } else {
        echo "<p>No se encontraron datos del clima en la base de datos.</p>";
    }

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

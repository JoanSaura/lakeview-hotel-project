<?php
function displayWeather() {
    $root = $_SERVER['DOCUMENT_ROOT'];
    include $root . '/student071/dwes/files/common-files/db_connection.php';
    
    $sql = "SELECT * FROM `071_weather` ORDER BY api_inserted_on DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $api_data = json_decode($row['api_json'], true);
        
        // Depuración: Ver qué contiene el JSON
        echo '<pre>';
        print_r($api_data);
        echo '</pre>';
        
        if (isset($api_data['Temperature']['Value']) && isset($api_data['Temperature']['Unit']) && isset($api_data['WeatherIcon'])) {
            $temperature = $api_data['Temperature']['Value']; 
            $unit = $api_data['Temperature']['Unit']; 
            $icon = $api_data['WeatherIcon']; 
        } else {
            echo "Faltan datos del clima en el JSON.";
            return;
        }
        
        if (!$temperature) $temperature = 0;
        if (!$unit) $unit = '°C'; 
        if (!$icon) $icon = 'sun'; 
    } else {
        echo "No se encontraron datos del clima en la base de datos.";
        return;
    }

    $dayOfWeek = date('l');
    
    echo '<div id="weather">
            <div class="weather-info">
                <div class="temperature">
                    <span class="temp-value">' . $temperature . '</span>
                    <span class="temp-unit">' . $unit . '</span>
                </div>
                <div class="day">
                    <span>' . $dayOfWeek . '</span>
                </div>
                <div class="icon">
                    <img src="http://developer.accuweather.com/sites/default/files/' . $icon . '-s.png" alt="Weather Icon">
                </div>
            </div>
          </div>';
}
?>
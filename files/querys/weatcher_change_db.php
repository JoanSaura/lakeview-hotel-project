<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');

$apikey = 'GUQyxJ2sAeDuGxda70jTYpNSumX5AEox';
$city = 'Madrid';

$url = "http://dataservice.accuweather.com/locations/v1/cities/search?apikey={$apikey}&q={$city}";
$response = file_get_contents($url);
$cityData = json_decode($response, true);

if (isset($cityData[0]['Key'])) {
    $locationkey = $cityData[0]['Key']; 
} else {
    echo "No se encontró la ciudad de Madrid.";
    exit;
}

$url = "http://dataservice.accuweather.com/currentconditions/v1/{$locationkey}?apikey={$apikey}&language=en-us&details=false";
$response = file_get_contents($url);
$weatherData = json_decode($response, true);

if (isset($weatherData[0])) {
    $api_json = json_encode($weatherData[0], JSON_PRETTY_PRINT);
} else {
    echo "No se pudieron obtener los datos del clima.";
    exit;
}

$inserted_on = date("Y-m-d");

$sql = "INSERT INTO `071_weather` (api_name, api_inserted_on, api_json) VALUES ('accuweather', '{$inserted_on}', '{$api_json}')";

if (mysqli_query($conn, $sql)) {
    echo 'Nuevo JSON insertado correctamente.';
} else {
    echo "Error al insertar: " . mysqli_error($conn);
}
?>

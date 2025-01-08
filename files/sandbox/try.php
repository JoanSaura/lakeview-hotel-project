<?php
$file = 'errors.txt';

if (file_exists($file)) {
    $handle = fopen($file, 'r');

    if ($handle) {
        echo fgets($handle); 
        fclose($handle); 
    } else {
        echo "Error: No se pudo abrir el archivo.";
    }
} else {
    echo "Error: El archivo 'errors.txt' no existe.";
}
?>

<?php
 function getRoomImage($roomTypeId) {
    $imagePath = '/student071/dwes/img/rooms/';  
    
    $roomImages = [
        1 => 'singleroom.jpg',  
        2 => 'doubleroom.jpg',
        3 => 'suiteroom.jpg',
        4 => 'deluxeroom.jpg',
        5 => 'familyroom.jpg',
        6 => 'studioapartment.jpg',
        7 => 'penthousesuite.jpg',
        8 => 'shareddormitory.jpg',
        9 => 'executiveroom.jpg',
        10 => 'hooneymoonsuite.jpg',
        11 => 'accesibleroom.jpg',
        12 => 'twinroom.jpg',
        13 => 'presidentialsuite.jpg',
        14 => 'economyroom.jpg',
    ];

    if (array_key_exists($roomTypeId, $roomImages)) {
        return $imagePath . $roomImages[$roomTypeId];  
    } else {
        echo 'Ruta de imagen predeterminada: ' . $imagePath . 'default.jpg' . '<br>';
        return $imagePath . 'default.jpg';  
    }
}

?>

<?php
function showPopup($message, $type = 'success', $redirect_url = '') {
    $popup_class = ($type == 'success') ? 'popup-success' : 'popup-error';
    
    $redirect_script = '';
    if ($type == 'success' && $redirect_url != '') {
        $redirect_script = "setTimeout(function() { window.location.href = '$redirect_url'; }, 2000);"; 
    } elseif ($type == 'error' && $redirect_url != '') {
        $redirect_script = "setTimeout(function() { window.location.href = '$redirect_url'; }, 2000);";
    }

    echo "
    <div class='popup-container'>
        <div class='popup $popup_class'>
            <span class='popup-close' onclick='closePopup()'>&times;</span>
            <p>$message</p>
        </div>
    </div>
    
    <style>
        .popup-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            text-align: center;
            position: relative;
            transition: opacity 0.3s ease;
        }

        .popup-success {
            border-left: 5px solid green;
        }

        .popup-error {
            border-left: 5px solid red;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .popup p {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        /* Animación de Fade In */
        .popup-container {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>

    <script>
        function closePopup() {
            document.querySelector('.popup-container').style.display = 'none';
        }

        // Ejecutar la redirección si es necesario
        $redirect_script
    </script>
    ";
}

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

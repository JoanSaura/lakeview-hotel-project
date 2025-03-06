<?php

// Definir respuestas predefinidas
$responses = [
    "hola" => "¡Hola! ¿En qué puedo ayudarte?",
    "horario" => "Nuestro check-in es desde las 14:00 y check-out hasta las 12:00.",
    "habitaciones" => "Tenemos habitaciones estándar, suites y premium. ¿Cuál te interesa?",
    "precio" => "Los precios ependen de la temporada. Puedes ver más en nuestra web.",
    "gracias" => "¡De nada! Si tienes más dudas, aquí estaré.",
];

// Función para obtener la respuesta del chatbot
function getBotResponse($userMessage) {
    global $responses;
    $response = "Lo siento, no entiendo tu pregunta.";
    foreach ($responses as $key => $reply) {
        if (strpos(strtolower($userMessage), $key) !== false) {
            $response = $reply;
            break;
        }
    }
    return $response;
}

// Inicializar historial de chat en sesión si no existe
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

// Procesar mensaje enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_message'])) {
    $userMessage = trim($_POST['user_message']);
    if (!empty($userMessage)) {
        $botResponse = getBotResponse($userMessage);
        $_SESSION['chat_history'][] = ["user" => $userMessage, "bot" => $botResponse];
    }
}
?>

<div id="chatbot-container" class="closed">
    <div id="chatbot-header" onclick="toggleChatbot()">💬 Asistente Virtual</div>
    <div id="chatbot-body">
        <div id="chatbox">
            <?php
            foreach ($_SESSION['chat_history'] as $chat) {
                echo '<div class="user-message">' . htmlspecialchars($chat['user']) . '</div>';
                echo '<div class="bot-message">' . htmlspecialchars($chat['bot']) . '</div>';
            }
            ?>
        </div>
        <form method="POST">
            <input type="text" id="chat-input" name="user_message" placeholder="Escribe un mensaje..." required />
            <button id="send-btn" type="submit">Enviar</button>
        </form>
    </div>
</div>

<script>
    function toggleChatbot() {
        document.getElementById("chatbot-container").classList.toggle("closed");
    }
</script>

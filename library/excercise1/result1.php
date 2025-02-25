<?php

$name = $_POST['name'] ?? '';

if (empty($name)) {
    echo "Debes ingresar un nombre";
    exit();
}

$url = "https://api.genderize.io/?name=" . urlencode($name);

// Abrir la URL como un archivo
$stream = fopen($url, 'r');

if (!$stream) {
    echo "Error al conectar con la API.";
    exit();
}

// Leer el contenido de la respuesta
$response = stream_get_contents($stream);

// Cerrar el stream
fclose($stream);

// Decodificar JSON
$data = json_decode($response, true);

if ($data) {
    var_dump($data);
} else {
    echo "Error al procesar la respuesta.";
}
?>
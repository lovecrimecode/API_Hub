<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
<?php

$keyword = $_POST['keyword'];

if (empty($keyword)) {
    echo "Debes ingresar una palabra clave.";
    exit();
}

$apiUrl = 'https://api.imagepig.com/';

$apiKey = 'd8fb5199-ab71-4d2c-95ce-ed6356c43db2';

$data = json_encode(['prompt' => $keyword]);

$ch = curl_init($apiUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'api-key: ' . $apiKey,
    'User-Agent: Mozilla/5.0'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo 'Error de cURL: ' . curl_error($ch);
    curl_close($ch);
    exit();
}

curl_close($ch);


if ($httpCode !== 200) {
    echo "Error en la solicitud a la API. Código HTTP: $httpCode. Respuesta: $response";
    exit();
}

$responseData = json_decode($response, true);

if (isset($responseData['image_data'])) {
    $imageData = $responseData['image_data'];

    echo "<hr>";
    echo "<div class='container'>";
    echo "<h1 class='title result-title'>Resultados</h1>";
    echo "<p>Palabra clave para generar la imagen: {$keyword}</p><br>";
    echo "<p>Imagen generada:</p>";
    echo "<img src='data:image/jpeg;base64,{$imageData}' alt='Imagen generada' width='80%' align='center'>";
    echo "</div>";
} else {
    echo "No se pudo generar la imagen. Respuesta de la API: " . print_r($responseData, true);
}
?>
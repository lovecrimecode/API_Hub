<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="/library/template/style.css">

<?php
$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';

if (empty($keyword)) {
    echo '<div class="error-container">
              <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error</h1>
              <p class="subtitle has-text-white">Debes ingresar una palabra clave</p>
              <p>Por favor, regresa y completa el formulario correctamente.</p>
          </div>';
    echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
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
    echo '<div class="error-container">
              <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error de cURL</h1>
              <p class="subtitle has-text-white">No se pudo conectar con la API: ' . htmlspecialchars(curl_error($ch)) . '</p>
          </div>';
    curl_close($ch);
    exit();
}
curl_close($ch);

if ($httpCode !== 200) {
    echo '<div class="error-container">
              <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error en la solicitud</h1>
              <p class="subtitle has-text-white">Código HTTP: ' . $httpCode . '</p>
              <p>' . htmlspecialchars($response) . '</p>
          </div>';
    exit();
}

$responseData = json_decode($response, true);

if (isset($responseData['image_data'])) {
    $imageData = $responseData['image_data'];
?>
    <div class="result-container">
        <div class="result-header">
            <div class="icon">
                <i class="fas fa-palette"></i>
            </div>
            <h1 class="title is-2 has-text-white mb-2">¡Resultado Obtenido!</h1>
            <p class="subtitle is-5 has-text-white">Imagen generada por IA</p>
        </div>

        <div class="result-body">
            <div class="stat-card">
                <h3 class="title is-4 mb-2">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Palabra Clave
                </h3>
                <p class="is-size-3 has-text-weight-bold has-text-info">
                    <?php echo htmlspecialchars($keyword); ?>
                </p>
            </div>

            <div class="stat-card">
                <h3 class="title is-4 mb-2">
                    <i class="fas fa-image mr-2"></i>
                    Imagen Generada
                </h3>
                <figure class="image is-5by3">
                    <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Imagen generada a partir de la palabra clave: <?php echo htmlspecialchars($keyword); ?>">
                </figure>
            </div>

            <div class="has-text-centered mt-4">
                <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                    <i class="fas fa-redo mr-2"></i>
                    Generar otra imagen
                </button>
            </div>
        </div>
    </div>
<?php
} else {
    echo '<div class="error-container">
              <i class="fas fa-question fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error</h1>
              <p class="subtitle has-text-white">No se pudo generar la imagen.</p>
              <p>Intenta con otra palabra clave o vuelve a intentarlo más tarde.</p>
          </div>';
}
?>
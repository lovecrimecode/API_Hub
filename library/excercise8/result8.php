<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
//require'vendor/autoload.php';
//use ImagePig\ImagePig;

$keyword = $_POST['keyword'];

if (!$_POST || !isset($_POST["keyword"])) {
    echo "Debes ingresar un nombre";
    exit();
}

$apiKey = 'd8fb5199-ab71-4d2c-95ce-ed6356c43db2'; // Reemplaza con tu API key
$imagepig = ImagePig\ImagePig($apiKey);

try {
    $result = $imagepig->default('$keyword');
    $imageData = $result->getData(); // Obtiene los datos de la imagen

    // Establece los encabezados HTTP para mostrar la imagen en el navegador
    header('Content-Type: image/jpeg'); // Ajusta el tipo de contenido según el formato de la imagen
    header('Content-Length: ' . strlen($imageData));

    // Muestra los datos de la imagen
    echo $imageData;

} catch (Exception $e) {
    // Si hay un error, envía un encabezado de error y muestra el mensaje
    header('HTTP/1.1 500 Internal Server Error');
    echo "Error: " . $e->getMessage();
}

// echo "<hr>";

// echo "<div class='container'>";

// echo "<h1 class='title result-title'>Resultados</h1>";

// echo "<p>Nombre: {$name}</p>";

// echo "<p>Género: {$response->gender}</p>";

// $response->probability = $response->probability * 100;
// echo "<p>Probabilidad: {$response->probability}%</p>";

// echo "</div>";
?>
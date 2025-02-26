<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$name = $_POST['name'];

if (!$_POST || !isset($_POST["name"])) {
    echo "Debes ingresar un nombre";
    exit();
}

$url = "https://api.agify.io/?name={$name}";

$response = file_get_contents($url);
$response = json_decode($response);

switch ($response->age) {
    case ($response->age <=18):
        $response->age = "Es joven (👶)";
        break;
    case ($response->age >18 && $response->age <65):
        $response->age = "Es adulto (🧑)";
        break;
    case ($response->age >=65):
        $response->age = "Es anciano (👴).";
        break;
    default:
        $response->age = "No se pudo determinar la edad.";
        break;
}

echo "<hr>";

echo "<div class='container'>";

echo "<h1 class='title result-title'>Resultados</h1>";

echo "<p>Nombre: {$name}</p>";

echo "<p>Edad: {$response->age}</p>";

echo "</div>";
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$name = $_POST['name'];

if (!$_POST || !isset($_POST["name"])) {
    echo "Debes ingresar un nombre";
    exit();
}

$url = "https://api.genderize.io/?name={$name}";

$response = file_get_contents($url);
$response = json_decode($response);

$response->gender = ($response->gender == 'male') ? 'Masculino' : 'Femenino';

if ($response->gender == 'Masculino') {
    echo "<style>body {background-color: #4a90e2;}</style>";
} else {
    echo "<style>body {background-color: #ff69b4;}</style>";
}

echo "<hr>";

echo "<div class='container'>";

echo "<h1 class='title result-title'>Resultados</h1>";

echo "<p>Nombre: {$name}</p>";

echo "<p>Género: {$response->gender}</p>";

$response->probability = $response->probability * 100;
echo "<p>Probabilidad: {$response->probability}%</p>";

echo "</div>";
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$dollars = $_POST['dollars'];

if (!$_POST || !isset($_POST["dollars"]) || $_POST["dollars"] != (string)(float)$_POST["dollars"]) {
    echo "Debes ingresar un valor numerico valido";
    exit();
}

$url = "https://api.exchangerate-api.com/v4/latest/USD";

$response = file_get_contents($url);
$response = json_decode($response);



$response->rates->DOP = $response->rates->DOP * $dollars;

echo "<div class='container'>";

echo "<h1 class='title result-title'>Resultados</h1>";

echo "<p>🪙{$dollars} USD = 🤑{$response->rates->DOP} RDS</p><br>";

echo "</div>";
?>

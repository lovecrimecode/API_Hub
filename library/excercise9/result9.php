<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
if (empty(trim($_POST['country']))) {
    exit("Debes ingresar un país válido");
}

$country = rawurlencode(trim($_POST['country']));
$url = "https://restcountries.com/v3.1/name/{$country}";

$response = @file_get_contents($url);
$data = json_decode($response, true)[0] ?? null;

if (!$data) {
    $url = "https://restcountries.com/v3.1/translation/{$country}";
    $response = @file_get_contents($url);
    $data = json_decode($response, true)[0] ?? null;
}

if (!$data) {
    exit("País no encontrado");
}

$name = $data['name']['common'] ?? "Desconocido";
$capital = $data['capital'][0] ?? "Desconocida";
$population = isset($data['population']) ? number_format($data['population']) : "Desconocida";
$currency = isset($data['currencies']) ? implode(", ", array_column($data['currencies'], 'name')) : "Desconocida";
$flag = $data['flags']['png'] ?? "";

echo "<div class='container'>";
echo "<h1 class='title'>Resultados</h1>";
echo "<p><strong>Nombre:</strong> {$name}</p>";
echo "<p><strong>Capital:</strong> {$capital}</p>";
echo "<p><strong>Población:</strong> {$population}</p>";
echo "<p><strong>Moneda:</strong> {$currency}</p>";
if ($flag) {
    echo "<img src='{$flag}' alt='Bandera de {$name}' width='80%'>";
}
echo "</div>";
?>

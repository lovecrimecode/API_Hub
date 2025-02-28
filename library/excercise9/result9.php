<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php

if (empty(trim($_POST['country'])) || !isset($_POST["country"])) {
    echo "Debes ingresar un pais valido";
    exit();
}

$country = trim($_POST['country']);
$country = urlencode($country);

$url = "https://restcountries.com/v3.1/name/{$country}";

$response = @file_get_contents($url);
$response = json_decode($response);

if (!$response || isset($response['message'])) {
    $url= "https://restcountries.com/v3.1/translation/{$country}";
    $response = @file_get_contents($url);
    $response = json_decode($response);
    if (!$response || isset($response['message'])) {
        echo "No se encontró información sobre el pais";
        exit();
    }
}

$country_data = $response[0];
$name = $country_data->name->common;
$capital = $country_data->capital[0];
$population = number_format($country_data->population);
$currency_code = array_key_first((array)$country_data->currencies);
$currency = $country_data->currencies->{$currency_code}->name;
$flag = $country_data->flags->png;

echo "<hr>";

echo "<div class='container'>";

echo "<h1 class='title result-title'>Resultados</h1>";

echo "<p>Nombre: {$name}</p>";

echo "<p>Capital: {$capital}</p><br>";
echo "<p>Población: {$population}</p><br>";
echo "<p>Moneda: {$currency}</p><br>";

echo "<img src='{$flag}' alt='Bandera no encontrada' width='80%' align='center'>";

echo "</div>";
?>

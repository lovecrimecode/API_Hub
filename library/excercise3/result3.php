<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$country = $_POST['country'];

if (!isset($_POST['country']) || empty(trim($_POST['country']))) {
    exit();
}

$country = trim($_POST['country']);
$country = str_replace(" ", "%20", $country);
$url = "http://universities.hipolabs.com/search?country={$country}";

$response = @file_get_contents($url);

$response = json_decode($response);

if (empty($response)) {
    echo "<p style='color: red;'>Debes ingresar un país válido</p>";
    exit();
}

echo "
<div class='container'>
<h1 class='title result-title'>Resultados</h1>
<ul>";

foreach ($response as $university) {
    echo "
    <li><strong>Universidad:</strong> {$university->name}</li>
        <ul>";
        echo "<strong>Paginas web:</strong>";
    foreach ($university->web_pages as $web) {
        echo "
        <li><a href='{$web}' target='_blank'>{$web}</a></li>";
    }
    echo "<strong>Dominios:</strong>";
    foreach ($university->domains as $domain) {
        echo "
        <li> <a href='http://{$domain}' target='_blank'>{$domain}</a></li>";
    }
    echo "</ul><hr>
    </li>";
}
echo "</ul>

</div>";
?>
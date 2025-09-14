<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$name = $_POST['name'];

if (!$_POST || !isset($_POST["name"])) {
     echo "Debes ingresar un nombre";
     exit();
}

$url = "https://pokeapi.co/api/v2/pokemon/{$name}";

$response = @file_get_contents($url);

if ($response === FALSE) {
     http_response_code(404);
     echo "No se encontró el Pokémon";
     exit();
}

$response = json_decode($response);

$photo = $response->sprites->front_default;
$name = ucfirst($name);

echo "<section class='section'>
<div class='container'>";
echo "<h1 class='title result-title'>Resultados</h1><br>";

echo "<h2 class='subtitle'><strong>Pokemon: </strong>{$name}</h2>";

echo "<img src='$photo' alt='Foto de {$name}'>";

echo "<p>Experiencia base: {$response->base_experience}</p>";

echo "<h3 class='subtitle' style='font:\"bold\";'>Habilidades</h3>
<ul>";
foreach ($response->abilities as $ability) {
     echo "<li>{$ability->ability->name}</li>";
}
echo "
</ul>
</div>
</section>";
?>
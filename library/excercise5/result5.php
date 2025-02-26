<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$name = $_POST['name'];

if (!$_POST || !isset($_POST["name"])) {
     echo "Debes ingresar un nombre";
     exit();
}

$url = "https://pokeapi.co/api/v2/pokemon/{$name}";

$response = file_get_contents($url);
$response = json_decode($response);

if (!$response) {
     echo "No se encontró el Pokémon";
     exit();
}

$photo = $response->sprites->front_default;

echo "<hr>";

echo "<div class='container'>";
echo "<h1 class='title result-title'>Resultados</h1>";

echo "<h2>{$name}</h2>";

echo "<img src='$photo' alt='Foto de {$name}'>";

echo "<p>Experiencia base: {$response->base_experience}</p>";

echo "<h3>Habilidades</h3>
<ul>
<?php foreach($response->abilities as $ability): ?>
<li> <?php echo $ability->ability->name; ?></li>
<?php endforeach; ?>
</ul>";

echo "</div>";
?>
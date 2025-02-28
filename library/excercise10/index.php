<?php
require_once(__DIR__ . '/../motor.php');

Template::apply();

$n10 = 10;
$excercise = get_excercise($n10);

if (!$excercise){
     echo '<h1 class="title">Ejercicio no encontrado</h1>

<p class="subtitle">El ejercicio que buscas no existe .< /p>

<a href="./">Volver al inicio</a>';

exit();
}

$excercise = (object) $excercise;

// ### **Generador de chistes** 🤣

// 🔗 API: [`https://official-joke-api.appspot.com/random_joke`](https://official-joke-api.appspot.com/random_joke)

// 📌 **Descripción:**

// - Mostrar un **chiste aleatorio** cada vez que el usuario visite la página.
// - **No necesita formulario**.

echo "<h1 class='title'>{$excercise->name}</h1>
<h1 class='subtitle'>{$excercise->description}</h1>
";

$joke = file_get_contents('https://official-joke-api.appspot.com/random_joke');

$joke = json_decode($joke);

echo "<p>{$joke->setup}<br>{$joke->punchline}</p>";
?>
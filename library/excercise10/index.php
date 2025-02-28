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

echo "<h1 class='title'>{$excercise->name}</h1>
<h1 class='subtitle'>{$excercise->description}</h1>
";

$joke = file_get_contents('https://official-joke-api.appspot.com/random_joke');

$joke = json_decode($joke);

echo "<div class='box' style='background-color:hsl(233, 100%, 63%);'>
     <p class='content' style='font-size: 18px;'>{$joke->setup}<br><strong>{$joke->punchline}</strong></p>
     <button class='button is-primary' onclick='location.reload()'>Otro chiste</button>
      </div>";
?>
<?php

require_once(__DIR__ . '/../motor.php');

Template::apply();

$n4 = 4;
$excercise = get_excercise($n4);

if (!$excercise) {
     echo '<h1 class="title">Ejercicio no encontrado</h1>

<p class="subtitle">El ejercicio que buscas no existe .< /p>

<a href="./">Volver al inicio</a>';

     exit();
}

$excercise = (object) $excercise;

?>

<h1 class="title"><?php echo $excercise->name; ?></h1>
<h1 class="subtitle"><?php echo $excercise->description; ?></h1>

<form method="post" action="/library/excercise4/result4.php" target="result">
     <div class="field">
          <label class="label">Ingresa una ciudad de la República Dominicana para ver el clima actual</label>
          <input class="input" type="text" name="city" placeholder="Pon la ciudad de la cual quieres ver el clima"
               required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 300px;"></iframe>
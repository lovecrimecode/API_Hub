<?php

require_once(__DIR__ . '/../motor.php');

Template::apply();

$n9 = 9;
$excercise = get_excercise($n9);

if (!$excercise){
     echo '<h1 class="title">Ejercicio no encontrado</h1>

<p class="subtitle">El ejercicio que buscas no existe .< /p>

<a href="./">Volver al inicio</a>';

exit();
}

$excercise = (object) $excercise;

?>

<h1 class="title"><?php echo $excercise->name; ?></h1>
<h1 class="subtitle"><?php echo $excercise->description; ?></h1>

<form method="post" action="./excercise9/result9.php" target="result">
     <div class="field">
          <label class="label">Pais del que quieres ver los datos:</label>
          <input class="input" type="text" name="country"  placeholder="Pon un pais aqui (ingles o español)" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 300px;"></iframe>
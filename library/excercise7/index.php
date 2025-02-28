<?php

require_once(__DIR__ . '/../motor.php');

Template::apply();

$n7 = 7;
$excercise = get_excercise($n7);

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

<form method="post" action="/library/excercise7/result7.php" target="result">
     <div class="field">
          <label class="label">Dinero en dolares</label>
          <input class="input" type="float" name="dollars"  placeholder="USD" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form> 
<hr>

<iframe name="result" style="width: 100%; height: 600px;"></iframe>
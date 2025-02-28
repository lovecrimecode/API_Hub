<body style="background: url('https://vignette3.wikia.nocookie.net/pokemon/images/e/e0/Pikachu_Land.png/revision/latest?cb=20151120195138') no-repeat center center fixed; background-size: cover;">
<div style="position: absolute; top: 0; left: 0; width: 100%; height: 150%; background: rgba(28, 23, 23, 0.5);"></div>
<?php

require_once(__DIR__ . '/../motor.php');

Template::apply();

$n5 = 5;
$excercise = get_excercise($n5);

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

<form method="post" action="/library/excercise5/result5.php" target="result">
     <div class="field">
          <label class="label">Nombre del pokemon</label>
          <input class="input" type="text" name="name"  placeholder="Pon el nombre del pokemon aqui" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 400px; border: none;"></iframe>
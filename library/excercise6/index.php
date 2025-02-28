<?php

require_once(__DIR__ . '/../motor.php');

Template::apply();

$n6 = 6;
$excercise = get_excercise($n6);

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

<form method="post" action="./excercise6/result6.php" target="result">
     <div class="field">
          <label for="page" class="label">Elige una pagina</label>
          <select name="page" id="page" class="select">
               <option value="https://techcrunch.com/">TechCrunch</option>
               <option value="https://www.nasa.gov/">NASA</option>               
               <option value="https://variety.com/">Variety Magazine</option>
               <option value="https://www.rollingstone.com/">Rolling Stone</option>
          </select>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 700px;"></iframe>
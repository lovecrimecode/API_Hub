<?php

require_once(__DIR__ . '/../motor.php');

Template::apply();

$n2 = 2;
$excercise = get_excercise($n2);

if (!$excercise){
     echo '<h1 class="title">Ejercicio no encontrado</h1>

<p class="subtitle">El ejercicio que buscas no existe .< /p>

<a href="./">Volver al inicio</a>';

exit();
}

$excercise = (object) $excercise;

// Predicción de edad 🎂​
// 🔗 API: https://api.agify.io/?name=meelad
// 📌 Descripción:
// Ingresar un nombre y determinar la edad estimada de la persona.
// Mostrar un mensaje indicando si es joven (👶), adulto (🧑) o anciano (👴).
// Agregar una imagen relativa a cada categoría.
// Formulario: Entrada de texto para el nombre.

?>

<h1 class="title"><?php echo $excercise->name; ?></h1>
<h1 class="subtitle"><?php echo $excercise->description; ?></h1>

<form method="post" action="result2.php" target="result">
     <div class="field">
          <label class="label">Nombre</label>
          <input class="input" type="text" name="name"  placeholder="Pon tu nombre aqui" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 600px;"></iframe>
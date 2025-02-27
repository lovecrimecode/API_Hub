<?php

require_once(__DIR__ . '/../motor.php');

Template::apply();

$n8 = 8;
$excercise = get_excercise($n8);

if (!$excercise){
     echo '<h1 class="title">Ejercicio no encontrado</h1>

<p class="subtitle">El ejercicio que buscas no existe .< /p>

<a href="./">Volver al inicio</a>';

exit();
}

$excercise = (object) $excercise;

// Generador de imágenes con IA 🖼️​
// 🔗 API: [Unsplash API u otra de imágenes]
// 📌 Descripción:
// Ingresar una palabra clave y mostrar una imagen generada basada en la búsqueda.
// Formulario: Entrada de texto para la palabra clave.

?>

<h1 class="title"><?php echo $excercise->name; ?></h1>
<h1 class="subtitle"><?php echo $excercise->description; ?></h1>

<form method="post" action="excercise8/result8.php" target="result">
     <div class="field">
          <label class="label">Palabra clave</label>
          <input class="input" type="text" name="keyword"  placeholder="Ingresa la palabra clave para convertir en imagen" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 600px;"></iframe>
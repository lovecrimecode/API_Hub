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

// ### **Información de un Pokémon** ⚡

// 🔗 API: https://pokeapi.co/api/v2/pokemon/pikachu

// 📌 **Descripción:**

// - Ingresar el **nombre de un Pokémon** y mostrar su **foto, experiencia base y habilidades**.
// - Usar un diseño acorde al universo Pokémon 🎮.
// - **Formulario:** Entrada de texto para el nombre del Pokémon.

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

<iframe name="result" style="width: 100%; height: 300px;"></iframe>
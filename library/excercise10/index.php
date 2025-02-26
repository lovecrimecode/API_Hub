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

?>

<h1 class="title"><?php echo $excercise->name; ?></h1>
<h1 class="subtitle"><?php echo $excercise->description; ?></h1>

<form method="post" action="result10.php" target="result">
     <div class="field">
          <label class="label">Nombre</label>
          <input class="input" type="text" name="name"  placeholder="Pon tu nombre aqui" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 300px;"></iframe>
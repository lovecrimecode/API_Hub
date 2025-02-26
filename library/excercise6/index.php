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

// Noticias desde WordPress 📰​
// 🔗 API: [Buscar una API de WordPress REST]
// 📌 Descripción:
// Obtener las últimas 3 noticias de una página hecha con WordPress.
// Mostrar el logo de la página, los titulares, resúmenes y enlaces.
// Formulario: Selección de una página de noticias para extraer los datos.

?>

<h1 class="title"><?php echo $excercise->name; ?></h1>
<h1 class="subtitle"><?php echo $excercise->description; ?></h1>

<form method="post" action="result6.php" target="result">
     <div class="field">
          <label class="label">Pagina de noticias</label>
          <input class="input" type="text" name="news_page"  placeholder="Pon tu nombre aqui" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 300px;"></iframe>
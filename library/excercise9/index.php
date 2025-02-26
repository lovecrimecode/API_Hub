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

// ### **Datos de un país** 🌍

// 🔗 API: [`https://restcountries.com/v3.1/name/dominican`](https://restcountries.com/v3.1/name/dominican)

// 📌 **Descripción:**

// - Ingresar el **nombre de un país** y mostrar su **bandera, capital, población y moneda**.
// - **Formulario:** Entrada de texto para el nombre del país.

?>

<h1 class="title"><?php echo $excercise->name; ?></h1>
<h1 class="subtitle"><?php echo $excercise->description; ?></h1>

<form method="post" action="result9.php" target="result">
     <div class="field">
          <label class="label">Pais</label>
          <input class="input" type="text" name="country"  placeholder="Pon un pais aqui" required>
     </div>
     <button class="button is-primary">Enviar</button>
</form>

<iframe name="result" style="width: 100%; height: 300px;"></iframe>
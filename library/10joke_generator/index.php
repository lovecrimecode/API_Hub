<?php
require_once(__DIR__ . '/../motor.php');
Template::apply();

$n10 = 10;
$excercise = get_excercise($n10);

if (!$excercise) {
     echo '<div class="error-container">
              <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
              <h1 class="title has-text-white">Ejercicio no encontrado</h1>
              <p class="subtitle has-text-white">El ejercicio que buscas no existe.</p>
              <a href="./" class="button is-light">
                  <i class="fas fa-arrow-left mr-2"></i>
                  Volver al inicio
              </a>
          </div>';
     exit();
}

$excercise = (object) $excercise;

$joke = @file_get_contents('https://official-joke-api.appspot.com/random_joke');
$joke = json_decode($joke);

if ($joke === FALSE || !isset($joke->setup) || !isset($joke->punchline)) {
     echo '<div class="error-container">
              <i class="fas fa-wifi fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error de conexión</h1>
              <p class="subtitle has-text-white">No se pudo obtener un chiste.</p>
              <p>Por favor, verifica tu conexión e intenta de nuevo.</p>
          </div>';
     exit();
}
?>

<div class="result-container">
     <div class="result-header" style="background: hsl(233, 100%, 63%);">
          <div class="icon">
               <i class="fas fa-laugh-squint"></i>
          </div>
          <h1 class="title is-2 has-text-white mb-2">¡Hora de un chiste!</h1>
          <p class="subtitle is-5 has-text-white"><?php echo htmlspecialchars($excercise->name); ?></p>
     </div>

     <div class="result-body">
          <div class="stat-card" style="border-left-color: hsl(233, 100%, 63%);">
               <h3 class="title is-4 mb-2">
                    <i class="fas fa-question-circle mr-2" style="color: hsl(233, 100%, 63%);"></i>
                    Pregunta
               </h3>
               <p class="is-size-3 has-text-weight-bold" style="color: hsl(233, 100%, 63%);">
                    <?php echo htmlspecialchars($joke->setup); ?>
               </p>
          </div>

          <div class="stat-card" style="border-left-color: hsl(233, 100%, 63%);">
               <h3 class="title is-4 mb-2">
                    <i class="fas fa-exclamation-circle mr-2" style="color: hsl(233, 100%, 63%);"></i>
                    Respuesta
               </h3>
               <p class="is-size-3 has-text-weight-bold" style="color: hsl(233, 100%, 63%);">
                    <?php echo htmlspecialchars($joke->punchline); ?>
               </p>
          </div>

          <div class="has-text-centered mt-4">
               <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                    <i class="fas fa-redo mr-2"></i>
                    Otro chiste
               </button>
          </div>
     </div>
</div>
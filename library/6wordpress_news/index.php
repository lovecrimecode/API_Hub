<?php
require_once(__DIR__ . '/../motor.php');
Template::apply();

$n6 = 6;
$excercise = get_excercise($n6);

if (!$excercise) {
     echo '<div class="notification is-danger">
          <h1 class="title has-text-white">
               <i class="fas fa-exclamation-triangle mr-2"></i>
               Ejercicio no encontrado
          </h1>
          <p class="subtitle has-text-white">El ejercicio que buscas no existe.</p>
          <a href="./" class="button is-light">
               <i class="fas fa-arrow-left mr-2"></i>
               Volver al inicio
          </a>
     </div>';
     exit();
}

$excercise = (object) $excercise;
?>

<div class="exercise-header">
     <div class="icon-wrapper">
          <i class="fas fa-newspaper fa-2x"></i>
     </div>
     <h1 class="title has-text-white is-size-2"><?php echo $excercise->name; ?></h1>
     <h2 class="subtitle has-text-white is-size-5"><?php echo $excercise->description; ?></h2>
</div>

<div class="form-container">
     <form method="post" action="result6.php" target="result" id="newsForm">
          <div class="field">
               <label class="label is-size-5">
                    <i class="fas fa-globe mr-2"></i>
                    Elige una página
               </label>
               <div class="control">
                    <div class="select is-large">
                         <select name="page" id="page">
                              <option value="https://techcrunch.com/">TechCrunch</option>
                              <option value="https://www.nasa.gov/">NASA</option>
                              <option value="https://variety.com/">Variety Magazine</option>
                              <option value="https://www.rollingstone.com/">Rolling Stone</option>
                         </select>
                    </div>
               </div>
          </div>

          <div class="field">
               <div class="control has-text-centered">
                    <button class="button is-primary is-large submit-button" type="submit">
                         <i class="fas fa-search mr-2"></i>
                         Buscar Página
                    </button>
               </div>
          </div>
     </form>
</div>

<div class="feature-card">
     <h4 class="has-text-weight-semibold mb-2">
          <i class="fas fa-info-circle mr-2 has-text-info"></i>
          ¿Cómo funciona?
     </h4>
     <p class="is-size-7">
          Utilizamos una API para obtener información relevante sobre la página web seleccionada.
     </p>
</div>

<div class="result-container">
     <div class="loading-overlay" id="loadingOverlay">
          <div class="has-text-centered">
               <div class="spinner-border" role="status">
                    <i class="fas fa-spinner fa-spin fa-2x has-text-primary"></i>
               </div>
               <p class="mt-3 has-text-weight-semibold">Cargando información...</p>
          </div>
     </div>
     <iframe name="result" class="results-iframe" id="resultsFrame"></iframe>
</div>
<hr>

<div class="notification is-info is-light">
     <h4 class="title is-5">
          <i class="fas fa-lightbulb mr-2"></i>
          Datos Curiosos
     </h4>
     <div class="columns">
          <div class="column">
               <p><strong>Variedad:</strong> Sitios de tecnología, ciencia y entretenimiento</p>
          </div>
          <div class="column">
               <p><strong>Información:</strong> Datos actualizados de fuentes confiables</p>
          </div>
          <div class="column">
               <p><strong>Acceso:</strong> Links directos a las páginas seleccionadas</p>
          </div>
     </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          const form = document.getElementById('newsForm');
          const loadingOverlay = document.getElementById('loadingOverlay');
          const resultsFrame = document.getElementById('resultsFrame');

          form.addEventListener('submit', function() {
               loadingOverlay.classList.add('is-active');

               // Hide loading after iframe loads
               resultsFrame.addEventListener('load', function() {
                    setTimeout(() => {
                         loadingOverlay.classList.remove('is-active');
                    }, 500);
               });
          });

          // Add enter key support
          form.addEventListener('keypress', function(e) {
               if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
               }
          });
     });
</script>
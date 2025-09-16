<?php
require_once(__DIR__ . '/../motor.php');
Template::apply();

$n3 = 3;
$excercise = get_excercise($n3);

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
          <i class="fas fa-university fa-2x"></i>
     </div>
     <h1 class="title has-text-white is-size-2"><?php echo $excercise->name; ?></h1>
     <h2 class="subtitle has-text-white is-size-5"><?php echo $excercise->description; ?></h2>
</div>

<div class="form-container">
     <form method="post" action="result3.php" target="result" id="universityForm">
          <div class="field">
               <label class="label is-size-5">
                    <i class="fas fa-globe mr-2"></i>
                    Ingresa el país (en inglés)
               </label>
               <div class="control has-icons-left">
                    <input class="input is-large custom-input"
                         type="text"
                         name="country"
                         placeholder="Escribe el nombre del país aquí..."
                         required>
               </div>
          </div>

          <div class="field">
               <div class="control has-text-centered">
                    <button class="button is-primary is-large submit-button" type="submit">
                         <i class="fas fa-search mr-2"></i>
                         Buscar Universidades
                    </button>
               </div>
          </div>
     </form>
</div>

<div class="result-container">
     <div class="loading-overlay" id="loadingOverlay">
          <div class="has-text-centered">
               <div class="spinner-border" role="status">
                    <i class="fas fa-spinner fa-spin fa-2x has-text-primary"></i>
               </div>
               <p class="mt-3 has-text-weight-semibold">Buscando universidades...</p>
          </div>
     </div>
     <iframe name="result" class="results-iframe" id="resultsFrame"></iframe>
</div>

<hr>

<div class="feature-card">
     <h4 class="has-text-weight-semibold mb-2">
          <i class="fas fa-info-circle mr-2 has-text-info"></i>
          ¿Cómo funciona?
     </h4>
     <p class="is-size-7">
          Utilizamos la API de Hipolabs para listar universidades por país.
     </p>
</div>

<br>

<div class="notification is-info is-light">
     <h4 class="title is-5">
          <i class="fas fa-lightbulb mr-2"></i>
          Datos Curiosos
     </h4>
     <div class="columns">
          <div class="column">
               <p><strong>Cobertura:</strong> Universidades de todo el mundo</p>
          </div>
          <div class="column">
               <p><strong>Datos:</strong> Incluye sitios web y dominios</p>
          </div>
          <div class="column">
               <p><strong>Actualización:</strong> Base de datos mantenida regularmente</p>
          </div>
     </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          const form = document.getElementById('universityForm');
          const loadingOverlay = document.getElementById('loadingOverlay');
          const resultsFrame = document.getElementById('resultsFrame');

          form.addEventListener('submit', function() {
               loadingOverlay.style.display = 'block';
               resultsFrame.style.display = 'none';

               resultsFrame.addEventListener('load', function onLoad() {
                    setTimeout(() => {
                         loadingOverlay.style.display = 'none';
                    }, 500);

                    resultsFrame.style.display = 'block';

                    try {
                         const iframeDoc = resultsFrame.contentDocument || resultsFrame.contentWindow.document;
                         const contentHeight = iframeDoc.body.scrollHeight;
                         resultsFrame.style.height = `${contentHeight}px`;
                    } catch (e) {
                         resultsFrame.style.height = '600px';
                    }
                    resultsFrame.removeEventListener('load', onLoad);
               });
          });

          form.addEventListener('keypress', function(e) {
               if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
               }
          });
     });
</script>

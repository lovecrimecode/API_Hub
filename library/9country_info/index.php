<?php
require_once(__DIR__ . '/../motor.php');
Template::apply();

$n9 = 9;
$excercise = get_excercise($n9);

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
          <i class="fas fa-globe fa-2x"></i>
     </div>
     <h1 class="title has-text-white is-size-2"><?php echo $excercise->name; ?></h1>
     <h2 class="subtitle has-text-white is-size-5"><?php echo $excercise->description; ?></h2>
</div>

<div class="form-container">
     <form method="post" action="9country_info/result9.php" target="result" id="countryForm">
          <div class="field">
               <label class="label is-size-5">
                    <i class="fas fa-globe mr-2"></i>
                    Ingresa el nombre del país
               </label>
               <div class="control has-icons-left">
                    <input class="input is-large custom-input"
                         type="text"
                         name="country"
                         placeholder="Escribe el nombre del país (e.g., Dominican Republic)..."
                         required>
                    <span class="icon is-left">
                         <i class="fas fa-globe"></i>
                    </span>
               </div>
               <p class="help">Buscaremos información detallada del país especificado</p>
          </div>

          <div class="field">
               <div class="control has-text-centered">
                    <button class="button is-primary is-large submit-button" type="submit">
                         <i class="fas fa-search mr-2"></i>
                         Buscar País
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
               <p class="mt-3 has-text-weight-semibold">Buscando información del país...</p>
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
          Utilizamos una API para obtener datos detallados sobre países, incluyendo población, capital y más.
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
               <p><strong>Cobertura:</strong> Información de más de 200 países</p>
          </div>
          <div class="column">
               <p><strong>Datos:</strong> Incluye población, capital y banderas</p>
          </div>
          <div class="column">
               <p><strong>Actualización:</strong> Datos actualizados regularmente</p>
          </div>
     </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          const form = document.getElementById('countryForm');
          const loadingOverlay = document.getElementById('loadingOverlay');
          const resultsFrame = document.getElementById('resultsFrame');

          form.addEventListener('submit', function() {
               // Muestra el overlay de carga y oculta el iframe
               loadingOverlay.style.display = 'block';
               resultsFrame.style.display = 'none';

               // Escucha el evento 'load' del iframe
               resultsFrame.addEventListener('load', function() {
                    // Oculta el overlay de carga
                    setTimeout(() => {
                         loadingOverlay.style.display = 'none';
                    }, 500);

                    // Muestra el iframe
                    resultsFrame.style.display = 'block';

                    // Ajusta la altura del iframe al contenido cargado
                    try {
                         const iframeDoc = resultsFrame.contentDocument || resultsFrame.contentWindow.document;
                         const contentHeight = iframeDoc.body.scrollHeight;
                         resultsFrame.style.height = `${contentHeight}px`;
                    } catch (e) {
                         console.error("No se pudo ajustar la altura del iframe. Posible error de Same-Origin Policy.", e);
                         // Establece una altura fija si no se puede acceder al contenido del iframe
                         resultsFrame.style.height = '600px';
                    }
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
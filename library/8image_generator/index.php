<?php
require_once(__DIR__ . '/../motor.php');
Template::apply();

$n8 = 8;
$excercise = get_excercise($n8);

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
          <i class="fas fa-image fa-2x"></i>
     </div>
     <h1 class="title has-text-white is-size-2"><?php echo $excercise->name; ?></h1>
     <h2 class="subtitle has-text-white is-size-5"><?php echo $excercise->description; ?></h2>
</div>

<div class="form-container">
     <form method="post" action="8image_generator/result8.php" target="result" id="imageForm">
          <div class="field">
               <label class="label is-size-5">
                    <i class="fas fa-pencil-alt mr-2"></i>
                    Ingresa una descripción para la imagen
               </label>
               <div class="control has-icons-left">
                    <input class="input is-large custom-input"
                         type="text"
                         name="keyword"
                         placeholder="Escribe una descripción (e.g., 'atardecer en la playa')..."
                         required>
                    <span class="icon is-left">
                         <i class="fas fa-pencil-alt"></i>
                    </span>
               </div>
               <p class="help">Generaremos una imagen basada en tu descripción</p>
          </div>

          <div class="field">
               <div class="control has-text-centered">
                    <button class="button is-primary is-large submit-button" type="submit">
                         <i class="fas fa-magic mr-2"></i>
                         Generar Imagen
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
               <p class="mt-3 has-text-weight-semibold">Generando imagen...</p>
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
          Utilizamos una API de inteligencia artificial para generar imágenes únicas basadas en descripciones textuales.
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
               <p><strong>Tecnología:</strong> Inteligencia artificial avanzada</p>
          </div>
          <div class="column">
               <p><strong>Creatividad:</strong> Imágenes únicas generadas al instante</p>
          </div>
          <div class="column">
               <p><strong>Aplicaciones:</strong> Arte, diseño y más</p>
          </div>
     </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          const form = document.getElementById('imageForm');
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
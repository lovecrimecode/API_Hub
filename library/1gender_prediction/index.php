<?php
require_once(__DIR__ . '/../motor.php');
Template::apply();

$n1 = 1;
$excercise = get_excercise($n1);

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
          <i class="fas fa-user-friends fa-2x"></i>
     </div>
     <h1 class="title has-text-white is-size-2"><?php echo $excercise->name; ?></h1>
     <h2 class="subtitle has-text-white is-size-5"><?php echo $excercise->description; ?></h2>
</div>

<div class="form-container">

     <form method="post" action="result1.php" target="result" id="genderForm">
          <div class="field">
               <label class="label is-size-5">
                    <i class="fas fa-user mr-2"></i>
                    Ingresa tu nombre
               </label>
               <div class="control has-icons-left">
                    <input class="input is-large custom-input"
                         type="text"
                         name="name"
                         placeholder="Escribe tu nombre aquí..."
                         required
                         autocomplete="given-name">
               </div>
          </div>

          <div class="field">
               <div class="control has-text-centered">
                    <button class="button is-primary is-large submit-button" type="submit">
                         <i class="fas fa-search mr-2"></i>
                         Predecir Género
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
     <p class="is-size-7">a
          Utilizamos la API de Genderize.io que analiza millones de nombres
          para determinar la probabilidad de género basándose en datos estadísticos.
     </p>
</div>

<div class="result-container">
     <div class="loading-overlay" id="loadingOverlay">
          <div class="has-text-centered">
               <div class="spinner-border" role="status">
                    <i class="fas fa-spinner fa-spin fa-2x has-text-primary"></i>
               </div>
               <p class="mt-3 has-text-weight-semibold">Analizando tu nombre...</p>
          </div>
     </div>
     <iframe name="result" class="results-iframe" id="resultsFrame"></iframe>
</div>

<div class="notification is-info is-light">
     <h4 class="title is-5">
          <i class="fas fa-lightbulb mr-2"></i>
          Datos Curiosos
     </h4>
     <div class="columns">
          <div class="column">
               <p><strong>Precisión:</strong> La API tiene una precisión promedio del 85-90%</p>
          </div>
          <div class="column">
               <p><strong>Base de datos:</strong> Analiza más de 216,000 nombres únicos</p>
          </div>
          <div class="column">
               <p><strong>Cobertura:</strong> Funciona con nombres de 79 países diferentes</p>
          </div>
     </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          const form = document.getElementById('genderForm');
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

          // Add enter key support
          form.addEventListener('keypress', function(e) {
               if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
               }
          });
     });
</script>
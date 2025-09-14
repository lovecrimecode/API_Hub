<body style="background: url('https://vignette3.wikia.nocookie.net/pokemon/images/e/e0/Pikachu_Land.png/revision/latest?cb=20151120195138') no-repeat center center fixed; background-size: cover;">
     <?php
     require_once(__DIR__ . '/../motor.php');
     Template::apply();

     $n5 = 5;
     $excercise = get_excercise($n5);

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
               <i class="fas fa-paw fa-2x"></i>
          </div>
          <h1 class="title has-text-white is-size-2"><?php echo $excercise->name; ?></h1>
          <h2 class="subtitle has-text-white is-size-5"><?php echo $excercise->description; ?></h2>
     </div>

     <div ">
          <div class=" form-container" style="background: rgba(28, 23, 23, 0.59)">
          <form method=" post" action="result5.php" target="result" id="pokemonForm">
               <div class="field">
                    <label class="label is-size-5">
                         <i class="fas fa-star mr-2"></i>
                         Ingresa el nombre del Pokémon
                    </label>
                    <div class="control has-icons-left">
                         <input class="input is-large custom-input"
                              type="text"
                              name="name"
                              placeholder="Escribe el nombre del Pokémon aquí..."
                              required>
                    </div>
               </div>

               <div class="field">
                    <div class="control has-text-centered">
                         <button class="button is-primary is-large submit-button" type="submit">
                              <i class="fas fa-search mr-2"></i>
                              Buscar Pokémon
                         </button>
                    </div>
               </div>
          </form>
     </div>
     </div>

     <div class="feature-card" style="background: rgba(0, 0, 0, 0.66)">
          <h4 class="has-text-weight-semibold mb-2">
               <i class="fas fa-info-circle mr-2 has-text-info"></i>
               ¿Cómo funciona?
          </h4>
          <p class="is-size-7">
               Utilizamos la API de PokéAPI para obtener información detallada sobre Pokémon, como tipos y habilidades.
          </p>
     </div>

     <div class="result-container">
          <div class="loading-overlay" id="loadingOverlay">
               <div class="has-text-centered">
                    <div class="spinner-border" role="status">
                         <i class="fas fa-spinner fa-spin fa-2x has-text-primary"></i>
                    </div>
                    <p class="mt-3 has-text-weight-semibold">Buscando Pokémon...</p>
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
                    <p><strong>Variedad:</strong> Más de 1,000 Pokémon registrados</p>
               </div>
               <div class="column">
                    <p><strong>Datos:</strong> Incluye tipos, habilidades y estadísticas</p>
               </div>
               <div class="column">
                    <p><strong>API:</strong> PokéAPI es de código abierto</p>
               </div>
          </div>
     </div>

     <script>
          document.addEventListener('DOMContentLoaded', function() {
               const form = document.getElementById('pokemonForm');
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
<?php
require_once('library/motor.php');
Template::apply();
?>

               <div class="exercise-header">
                    <div class="icon-wrapper">
                         <i class="fas fa-rocket fa-3x"></i>
                    </div>
                    <h1 class="title has-text-white is-size-2">10 APIs</h1>
                    <h2 class="subtitle has-text-white is-size-5">Explora herramientas interactivas impulsadas por APIs</h2>
               </div>


     <div class="container">
          <div class="columns is-multiline">
               <?php
               $excercises = get_excercises_list();
               foreach ($excercises as $excercise) {
                    echo '
                <div class="column is-4">
                    <div class="card feature-card">
                        <div class="card-content">
                            <h3 class="title is-5">
                                <i class="' . htmlspecialchars($excercise['icon']) . ' mr-2 has-text-primary"></i>
                                ' . htmlspecialchars($excercise['name']) . '
                            </h3>
                            <p class="is-size-6">' . htmlspecialchars($excercise['description']) . '</p>
                            <a href="' . htmlspecialchars($excercise['url']) . '" class="button is-primary is-outlined mt-3">
                                <i class="fas fa-arrow-right mr-2"></i>
                                Probar
                            </a>
                        </div>
                    </div>
                </div>';
               }
               ?>
          </div>
     </div>

<hr>

<div class="container">
     <div class="notification is-info is-light">
          <h4 class="title is-5">
               <i class="fas fa-lightbulb mr-2"></i>
               ¿Qué es esto?
          </h4>
          <div class="columns">
               <div class="column">
                    <p><strong>APIs:</strong> Conexiones a datos en tiempo real</p>
               </div>
               <div class="column">
                    <p><strong>Interactividad:</strong> Formularios y resultados dinámicos</p>
               </div>
               <div class="column">
                    <p><strong>Variedad:</strong> Explora géneros, edades, clima, Pokémon y más</p>
               </div>
          </div>
     </div>
</div>

<?php
require_once('library/motor.php');

Template::apply();
?>

<h1 class="title">Tarea 5: APIs</h1>
<div class="content">
     <ul>
          <?php
          $excercises = get_excercises_list();
          foreach ($excercises as $excercise) {
               echo '<li><a href="' . $excercise['url'] . '">' . $excercise['name'] . '</a>: ' . $excercise['description'] . '</li>';
          }
          ?>
     </ul>
</div>

<br><br><hr><br>

<section class="section">
     <div class="container">
          <h2 class="subtitle">Creado por: <strong>Zelidee A. Guemez Henriquez</strong></h2>
          <img src='foto.jpg' style='width: 200px; height: 200px;'>
     </div>
</section>
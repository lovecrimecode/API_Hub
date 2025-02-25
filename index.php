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
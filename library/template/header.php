<?php
require_once __DIR__ . '/../template.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
     <title>Tarea 5</title>
</head>

<body>
     <nav class="navbar" role="navigation" aria-label="main navigation">

          <div class="navbar-brand">
               <a class="navbar-item" href="/">Tarea 5</a>
          </div>

          <div id="navbarBasicExample" class="navbar-menu">
               <div class="navbar-start">
                    <a class="navbar-item" href="/">
                         Inicio
                    </a>

                    <a class="navbar-item" href="about.php">
                         Acerca de
                    </a>

                    <div class="navbar-item has-dropdown is-hoverable">
                         <a class="navbar-link">
                              Ejercicios
                         </a>
                         <div class="navbar-dropdown">
                              <?php
                              $excercises = get_excercises_list();
                              foreach ($excercises as $excercise) {
                                   echo '<a class="navbar-item" href="' . $excercise['url'] . '">' . $excercise['name'] . '</a>';
                              }
                              ?>
                         </div>
                    </div>
               </div>
          </div>
     </nav>
     <section class="section">
          <div class="container">
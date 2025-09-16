<?php
require_once __DIR__ . '/../template.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="stylesheet" href="/library/template/style.css">
     <title>API Hub</title>
</head>

<body>
     <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
               <a class="navbar-item" href="/">
                    <i class="fas fa-code mr-2"></i>
                    10 APIs
               </a>

               <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
               </a>
          </div>


          <a class="navbar-item" href="/about.php">
               <i class="fas fa-info-circle mr-2"></i>
               Acerca de
          </a>

          <div class="navbar-item has-dropdown is-hoverable">
               <a class="navbar-item">
                    <i class="fas fa-tasks mr-2"></i>
                    Lista de APIs
               </a>
               <div class="navbar-dropdown">
                    <?php
                    $excercises = get_excercises_list();
                    foreach ($excercises as $excercise) {
                         echo '<a class="navbar-item" href="' . $excercise['url'] . '">
                                             <i class="fas ' . $excercise['icon'] . ' mr-2"></i>' . $excercise['name'] . '
                                        </a>';
                    }
                    ?>
               </div>
          </div>
          </div>
     </nav>

     <section class="section">
          <div class="container">

               <script>
                    document.addEventListener('DOMContentLoaded', () => {
                         // Mobile menu toggle
                         const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                         if ($navbarBurgers.length > 0) {
                              $navbarBurgers.forEach(el => {
                                   el.addEventListener('click', () => {
                                        const target = el.dataset.target;
                                        const $target = document.getElementById(target);

                                        el.classList.toggle('is-active');
                                        $target.classList.toggle('is-active');
                                   });
                              });
                         }
                    });
               </script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="stylesheet" href="/library/template/style.css">

     <?php
     $page = isset($_POST['page']) ? trim($_POST['page']) : '';

     if (empty($page)) {
          echo '<div class="error-container">
            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error</h1>
            <p class="subtitle has-text-white">Debes seleccionar una página válida</p>
            <p>Por favor, regresa y completa el formulario correctamente.</p>
        </div>';
          echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
          exit();
     }

     $icon = '';
     switch ($page) {
          case "https://techcrunch.com/":
               $icon = "https://logos-world.net/wp-content/uploads/2023/03/TechCrunch-Logo-2005.png";
               break;
          case "https://www.nasa.gov/":
               $icon = "https://logodix.com/logo/32534.jpg";
               break;
          case "https://variety.com/":
               $icon = "https://download.logo.wine/logo/Variety_(magazine)/Variety_(magazine)-Logo.wine.png";
               break;
          case "https://www.rollingstone.com/":
               $icon = "https://download.logo.wine/logo/Rolling_Stone/Rolling_Stone-Logo.wine.png";
               break;
     }

     $url = $page . '/wp-json/wp/v2/posts?_fields=title,link,excerpt';
     $response = @file_get_contents($url);

     if ($response === FALSE) {
          echo '<div class="error-container">
            <i class="fas fa-wifi fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error de conexión</h1>
            <p class="subtitle has-text-white">No se pudo conectar con el servicio</p>
            <p>Por favor, verifica tu conexión a internet e intenta nuevamente.</p>
        </div>';
          exit();
     }

     $posts = json_decode($response, true);
     if (empty($posts)) {
          echo '<div class="error-container">
            <i class="fas fa-question fa-3x mb-3"></i>
            <h1 class="title has-text-white">No se encontraron publicaciones</h1>
            <p class="subtitle has-text-white">No hay publicaciones disponibles para esta página</p>
            <p>Por favor, intenta con otra página.</p>
        </div>';
          echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
          exit();
     }

     $bgGradient = 'var(--neutral-gradient)';
     $pageColor = '#667eea';
     ?>
     <script>
          document.body.style.background = '<?php echo $bgGradient; ?>';
     </script>

     <div class="result-container">
          <div class="result-header" style="background: <?php echo $bgGradient; ?>">
               <div class="icon">
                    <i class="fas fa-newspaper"></i>
               </div>
               <h1 class="title is-2 has-text-white mb-2">¡Resultados Obtenidos!</h1>
               <p class="subtitle is-5 has-text-white">Últimas publicaciones de <?php echo htmlspecialchars(parse_url($page, PHP_URL_HOST)); ?></p>
          </div>

          <div class="result-body">
               <div class="stat-card" style="border-left-color: <?php echo $pageColor; ?>">
                    <h3 class="title is-4 mb-2">
                         <i class="fas fa-globe mr-2" style="color: <?php echo $pageColor; ?>"></i>
                         Página
                    </h3>
                    <figure class="image is-128x128">
                         <img src="<?php echo $icon; ?>" alt="Logo de la página">
                    </figure>
               </div>

               <?php for ($i = 0; $i < min(3, count($posts)); $i++): ?>
                    <div class="stat-card" style="border-left-color: <?php echo $pageColor; ?>">
                         <h3 class="title is-4 mb-2">
                              <i class="fas fa-newspaper mr-2" style="color: <?php echo $pageColor; ?>"></i>
                              <?php echo htmlspecialchars($posts[$i]['title']['rendered']); ?>
                         </h3>
                         <p class="is-size-5"><?php echo strip_tags($posts[$i]['excerpt']['rendered']); ?></p>
                         <a href="<?php echo htmlspecialchars($posts[$i]['link']); ?>" target="_blank" class="button is-link is-outlined mt-3">
                              <i class="fas fa-external-link-alt mr-2"></i>
                              Leer más
                         </a>
                    </div>
               <?php endfor; ?>

               <div class="has-text-centered mt-4">
                    <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                         <i class="fas fa-redo mr-2"></i>
                         Probar otra página
                    </button>
               </div>
          </div>
     </div>

     <script>
          document.addEventListener('DOMContentLoaded', function() {
               const statCards = document.querySelectorAll('.stat-card');
               statCards.forEach(card => {
                    card.addEventListener('click', function() {
                         this.style.transform = 'scale(0.98)';
                         setTimeout(() => {
                              this.style.transform = 'translateY(-5px)';
                         }, 100);
                    });
               });
          });
     </script>
</body>

</html>
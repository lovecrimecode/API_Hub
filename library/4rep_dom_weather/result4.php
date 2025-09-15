     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="stylesheet" href="/library/template/style.css">

     <?php
     $city = isset($_POST['city']) ? trim($_POST['city']) : '';

     if (empty($city)) {
          echo '<div class="error-container">
            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error</h1>
            <p class="subtitle has-text-white">Debes ingresar una ciudad válida</p>
            <p>Por favor, regresa y completa el formulario correctamente.</p>
        </div>';
          echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
          exit();
     }

     $city = urlencode($city);
     $url = "https://api.weatherapi.com/v1/current.json?key=8477ad31ff33421ba73220530252702&q={$city}&aqi=no";
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

     $response = json_decode($response, true);

     if (!isset($response['location']) || $response['location']['country'] !== 'Dominican Republic') {
          echo '<div class="error-container">
            <i class="fas fa-question fa-3x mb-3"></i>
            <h1 class="title has-text-white">Ciudad no válida</h1>
            <p class="subtitle has-text-white">La ciudad ingresada no pertenece a la República Dominicana</p>
            <p>Por favor, intenta con otra ciudad.</p>
        </div>';
          echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
          exit();
     }

     $condition = $response['current']['condition']['text'];
     $conditionCode = $response['current']['condition']['code'];
     $bgGradient = 'var(--neutral-gradient)';
     $conditionColor = '#2196F3';

     // Traducciones y ajustes de condición
     if ($response['current']['is_day'] == 1 && $conditionCode == 1000) {
          $condition = "Soleado";
          $bgGradient = 'linear-gradient(135deg, #4CAF50, #2196F3)';
     } elseif ($response['current']['is_day'] == 0 && $conditionCode == 1000) {
          $condition = "Despejado";
          $bgGradient = 'linear-gradient(135deg, #0D47A1, #4A148C)';
     } elseif (in_array($conditionCode, [1003])) {
          $condition = "Parcialmente nublado";
          $bgGradient = 'linear-gradient(135deg, #B0BEC5, #78909C)';
     } elseif (in_array($conditionCode, [1006, 1009])) {
          $condition = "Nublado";
          $bgGradient = 'linear-gradient(135deg, #78909C, #546E7A)';
     } elseif (in_array($conditionCode, [1063, 1150, 1153])) {
          $condition = "Lluvia ligera";
          $bgGradient = 'linear-gradient(135deg, #0288D1, #01579B)';
     } elseif (in_array($conditionCode, [1180, 1240])) {
          $condition = "Lluvia moderada";
          $bgGradient = 'linear-gradient(135deg, #0288D1, #01579B)';
     } elseif ($conditionCode == 1183) {
          $condition = "Lluvia fuerte";
          $bgGradient = 'linear-gradient(135deg, #0277BD, #004D40)';
     } elseif (in_array($conditionCode, [1186, 1246])) {
          $condition = "Lluvia torrencial";
          $bgGradient = 'linear-gradient(135deg, #01579B, #003300)';
     } elseif ($conditionCode == 1087) {
          $condition = "Tormenta eléctrica";
          $bgGradient = 'linear-gradient(135deg, #7B1FA2, #311B92)';
     } elseif ($conditionCode == 1243) {
          $condition = "Lluvia moderada o fuerte";
          $bgGradient = 'linear-gradient(135deg, #0288D1, #01579B)';
     }
     ?>
     <script>
          document.body.style.background = '<?php echo $bgGradient; ?>';
     </script>

     <div class="result-container">
          <div class="result-header" style="background: <?php echo $bgGradient; ?>">
               <div class="icon">
                    <i class="fas fa-cloud-sun"></i>
               </div>
               <h1 class="title is-2 has-text-white mb-2">¡Resultados Obtenidos!</h1>
               <p class="subtitle is-5 has-text-white">Clima actual en <?php echo htmlspecialchars($response['location']['name']); ?></p>
          </div>

          <div class="result-body">
               <div class="stat-card" style="border-left-color: <?php echo $conditionColor; ?>">
                    <h3 class="title is-4 mb-2">
                         <i class="fas fa-city mr-2" style="color: <?php echo $conditionColor; ?>"></i>
                         Ciudad
                    </h3>
                    <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $conditionColor; ?>">
                         <?php echo htmlspecialchars($response['location']['name']); ?>
                    </p>
               </div>

               <div class="stat-card" style="border-left-color: <?php echo $conditionColor; ?>">
                    <h3 class="title is-4 mb-2">
                         <i class="fas fa-thermometer-half mr-2" style="color: <?php echo $conditionColor; ?>"></i>
                         Temperatura
                    </h3>
                    <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $conditionColor; ?>">
                         <?php echo $response['current']['temp_c']; ?> °C
                    </p>
               </div>

               <div class="stat-card" style="border-left-color: <?php echo $conditionColor; ?>">
                    <h3 class="title is-4 mb-2">
                         <i class="fas fa-cloud mr-2" style="color: <?php echo $conditionColor; ?>"></i>
                         Condición
                    </h3>
                    <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $conditionColor; ?>">
                         <?php echo $condition; ?>
                    </p>
                    <figure class="image is-64x64 mt-3">
                         <img src="<?php echo $response['current']['condition']['icon']; ?>" alt="Weather icon">
                    </figure>
               </div>

               <div class="has-text-centered mt-4">
                    <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                         <i class="fas fa-redo mr-2"></i>
                         Probar otra ciudad
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
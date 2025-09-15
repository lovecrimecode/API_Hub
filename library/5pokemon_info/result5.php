<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="/library/template/style.css">

<?php
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

if (empty($name)) {
     echo '<div class="error-container">
            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error</h1>
            <p class="subtitle has-text-white">Debes ingresar un nombre de Pokémon válido</p>
            <p>Por favor, regresa y completa el formulario correctamente.</p>
        </div>';
     echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
     exit();
}

$url = "https://pokeapi.co/api/v2/pokemon/" . urlencode(strtolower($name));
$response = @file_get_contents($url);

if ($response === FALSE) {
     echo '<div class="error-container">
            <i class="fas fa-question fa-3x mb-3"></i>
            <h1 class="title has-text-white">Pokémon no encontrado</h1>
            <p class="subtitle has-text-white">No se encontró el Pokémon especificado</p>
            <p>Verifica el nombre e intenta nuevamente.</p>
        </div>';
     echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
     exit();
}

$response = json_decode($response, true);
$bgGradient = 'var(--neutral-gradient)';
$pokemonColor = '#FFCA28';
$name = ucfirst($name);
?>
<script>
     document.body.style.background = '<?php echo $bgGradient; ?>';
     window.parent.document.getElementById('resultsFrame').classList.add('loaded');
</script>

<div class="result-container">
     <div class="result-header" style="background: <?php echo $bgGradient; ?>">
          <div class="icon">
               <i class="fas fa-paw"></i>
          </div>
          <h1 class="title is-2 has-text-white mb-2">¡Resultados Obtenidos!</h1>
          <p class="subtitle is-5 has-text-white">Información sobre <?php echo htmlspecialchars($name); ?></p>
     </div>

     <div class="result-body">
          <div class="stat-card" style="border-left-color: <?php echo $pokemonColor; ?>">
               <h3 class="title is-4 mb-2">
                    <i class="fas fa-star mr-2" style="color: <?php echo $pokemonColor; ?>"></i>
                    Pokémon
               </h3>
               <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $pokemonColor; ?>">
                    <?php echo htmlspecialchars($name); ?>
               </p>
          </div>

          <div class="stat-card" style="border-left-color: <?php echo $pokemonColor; ?>">
               <h3 class="title is-4 mb-2">
                    <i class="fas fa-image mr-2" style="color: <?php echo $pokemonColor; ?>"></i>
                    Imagen
               </h3>
               <figure class="image is-128x128">
                    <img src="<?php echo $response['sprites']['front_default']; ?>" alt="Foto de <?php echo htmlspecialchars($name); ?>">
               </figure>
          </div>

          <div class="stat-card" style="border-left-color: <?php echo $pokemonColor; ?>">
               <h3 class="title is-4 mb-2">
                    <i class="fas fa-tachometer-alt mr-2" style="color: <?php echo $pokemonColor; ?>"></i>
                    Experiencia Base
               </h3>
               <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $pokemonColor; ?>">
                    <?php echo $response['base_experience']; ?>
               </p>
          </div>

          <div class="stat-card" style="border-left-color: <?php echo $pokemonColor; ?>">
               <h3 class="title is-4 mb-2">
                    <i class="fas fa-bolt mr-2" style="color: <?php echo $pokemonColor; ?>"></i>
                    Habilidades
               </h3>
               <ul>
                    <?php foreach ($response['abilities'] as $ability): ?>
                         <li class="is-size-5"><?php echo htmlspecialchars($ability['ability']['name']); ?></li>
                    <?php endforeach; ?>
               </ul>
          </div>

          <div class="has-text-centered mt-4">
               <button class="button is-primary is-rounded" onclick="window.parent.document.getElementById('pokemonForm').reset(); window.parent.document.getElementById('resultsFrame').classList.remove('loaded');">
                    <i class="fas fa-redo mr-2"></i>
                    Probar otro Pokémon
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
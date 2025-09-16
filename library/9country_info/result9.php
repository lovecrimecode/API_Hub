<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="/library/template/style.css">

<?php
$country = isset($_POST['country']) ? trim($_POST['country']) : '';

if (empty($country)) {
    echo '<div class="error-container">
              <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error</h1>
              <p class="subtitle has-text-white">Debes ingresar un país válido</p>
              <p>Por favor, regresa y completa el formulario correctamente.</p>
          </div>';
    echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
    exit();
}

$url = "https://restcountries.com/v3.1/name/" . rawurlencode($country);
$response = @file_get_contents($url);
$data = json_decode($response, true)[0] ?? null;

if (!$data) {
    $url = "https://restcountries.com/v3.1/translation/" . rawurlencode($country);
    $response = @file_get_contents($url);
    $data = json_decode($response, true)[0] ?? null;
}

if (!$data) {
    echo '<div class="error-container">
              <i class="fas fa-question fa-3x mb-3"></i>
              <h1 class="title has-text-white">País no encontrado</h1>
              <p class="subtitle has-text-white">No se encontró información para el país especificado.</p>
              <p>Verifica el nombre e intenta nuevamente.</p>
          </div>';
    exit();
}

$name = htmlspecialchars($data['name']['common'] ?? "Desconocido");
$capital = htmlspecialchars($data['capital'][0] ?? "Desconocida");
$population = isset($data['population']) ? number_format($data['population']) : "Desconocida";
$currency = isset($data['currencies']) ? implode(", ", array_column($data['currencies'], 'name')) : "Desconocida";
$flag = htmlspecialchars($data['flags']['png'] ?? "");
?>

<div class="result-container">
    <div class="result-header">
        <div class="icon">
            <i class="fas fa-globe"></i>
        </div>
        <h1 class="title is-2 has-text-white mb-2">¡Resultado Obtenido!</h1>
        <p class="subtitle is-5 has-text-white">Información sobre <?php echo $name; ?></p>
    </div>

    <div class="result-body">
        <div class="stat-card">
            <h3 class="title is-4 mb-2">
                <i class="fas fa-flag mr-2"></i>
                Bandera
            </h3>
            <?php if ($flag): ?>
                <figure class="image is-5by3">
                    <img src="<?php echo $flag; ?>" alt="Bandera de <?php echo $name; ?>">
                </figure>
            <?php else: ?>
                <p>Bandera no disponible</p>
            <?php endif; ?>
        </div>

        <div class="stat-card">
            <h3 class="title is-4 mb-2">
                <i class="fas fa-city mr-2"></i>
                Capital
            </h3>
            <p class="is-size-3 has-text-weight-bold has-text-info">
                <?php echo $capital; ?>
            </p>
        </div>

        <div class="stat-card">
            <h3 class="title is-4 mb-2">
                <i class="fas fa-users mr-2"></i>
                Población
            </h3>
            <p class="is-size-3 has-text-weight-bold has-text-info">
                <?php echo $population; ?>
            </p>
        </div>

        <div class="stat-card">
            <h3 class="title is-4 mb-2">
                <i class="fas fa-coins mr-2"></i>
                Moneda
            </h3>
            <p class="is-size-3 has-text-weight-bold has-text-info">
                <?php echo $currency; ?>
            </p>
        </div>

        <div class="has-text-centered mt-4">
            <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                <i class="fas fa-redo mr-2"></i>
                Probar otro país
            </button>
        </div>
    </div>
</div>
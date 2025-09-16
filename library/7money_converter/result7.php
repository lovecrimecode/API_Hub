<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="/library/template/style.css">

<?php
$dollars = isset($_POST['dollars']) ? trim($_POST['dollars']) : '';

if (!$_POST || !is_numeric($dollars)) {
    echo '<div class="error-container">
              <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error</h1>
              <p class="subtitle has-text-white">Debes ingresar una cantidad válida</p>
              <p>Por favor, regresa y completa el formulario correctamente.</p>
          </div>';
    echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
    exit();
}

$url = "https://api.exchangerate-api.com/v4/latest/USD";
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

$rates = json_decode($response)->rates ?? null;

if (!$rates || !isset($rates->DOP)) {
    echo '<div class="error-container">
              <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
              <h1 class="title has-text-white">Error de datos</h1>
              <p class="subtitle has-text-white">No se pudo obtener la tasa de cambio</p>
              <p>Intenta de nuevo más tarde.</p>
          </div>';
    exit();
}

$dop_amount = $dollars * $rates->DOP;
?>

<div class="result-container">
    <div class="result-header">
        <div class="icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <h1 class="title is-2 has-text-white mb-2">¡Resultado Obtenido!</h1>
        <p class="subtitle is-5 has-text-white">Conversión de moneda</p>
    </div>

    <div class="result-body">
        <div class="stat-card">
            <h3 class="title is-4 mb-2">
                <i class="fas fa-money-bill-wave mr-2"></i>
                Monto Convertido
            </h3>
            <p class="is-size-3 has-text-weight-bold has-text-primary">
                $<?php echo number_format($dollars, 2); ?> USD = RD$<?php echo number_format($dop_amount, 2); ?>
            </p>
        </div>

        <div class="has-text-centered mt-4">
            <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                <i class="fas fa-redo mr-2"></i>
                Probar otra cantidad
            </button>
        </div>
    </div>
</div>
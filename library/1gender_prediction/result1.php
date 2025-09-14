<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/library/template/style.css">
    <title>Resultados - Predicción de Género</title>
</head>

<body>

    <?php
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';

    if (!$_POST || !$name) {
        echo '<div class="error-container">
            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error</h1>
            <p class="subtitle has-text-white">Debes ingresar un nombre válido</p>
            <p>Por favor, regresa y completa el formulario correctamente.</p>
          </div>';
        echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
        exit();
    }

    $name = htmlspecialchars($name);
    $url = "https://api.genderize.io/?name=" . urlencode($name);

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

    $data = json_decode($response, true);

    if (!$data || !isset($data['gender'])) {
        echo '<div class="error-container">
            <i class="fas fa-question fa-3x mb-3"></i>
            <h1 class="title has-text-white">Nombre no encontrado</h1>
            <p class="subtitle has-text-white">No pudimos determinar el género para este nombre</p>
            <p>Es posible que sea un nombre muy poco común o no esté en nuestra base de datos.</p>
          </div>';
        exit();
    }

    // Process the data
    $gender = $data['gender'];
    $probability = round($data['probability'] * 100, 1);
    $count = $data['count'] ?? 0;

    $genderText = ($gender === 'male') ? 'Masculino' : 'Femenino';
    $genderIcon = ($gender === 'male') ? 'fas fa-mars' : 'fas fa-venus';
    $genderColor = ($gender === 'male') ? '#4a90e2' : '#ff69b4';
    $bgGradient = ($gender === 'male') ? 'var(--male-gradient)' : 'var(--female-gradient)';

    // Confidence level
    $confidenceLevel = '';
    $confidenceClass = '';
    if ($probability >= 90) {
        $confidenceLevel = 'Muy Alta';
        $confidenceClass = 'has-background-success has-text-white';
    } elseif ($probability >= 70) {
        $confidenceLevel = 'Alta';
        $confidenceClass = 'has-background-info has-text-white';
    } elseif ($probability >= 50) {
        $confidenceLevel = 'Media';
        $confidenceClass = 'has-background-warning has-text-black';
    } else {
        $confidenceLevel = 'Baja';
        $confidenceClass = 'has-background-danger has-text-white';
    }

    ?>

    <script>
        document.body.style.background = '<?php echo $bgGradient; ?>';
    </script>

    <div class="result-container">
        <div class="result-header" style="background: <?php echo $bgGradient; ?>">
            <div class="icon">
                <i class="<?php echo $genderIcon; ?>"></i>
            </div>
            <h1 class="title is-2 has-text-white mb-2">¡Resultado Obtenido!</h1>
            <p class="subtitle is-5 has-text-white">Análisis completado con éxito</p>
        </div>

        <div class="result-body">
            <div class="stat-card" style="border-left-color: <?php echo $genderColor; ?>">
                <h3 class="title is-4 mb-2">
                    <i class="fas fa-user mr-2" style="color: <?php echo $genderColor; ?>"></i>
                    Nombre Analizado
                </h3>
                <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $genderColor; ?>">
                    <?php echo $name; ?>
                </p>
            </div>

            <div class="stat-card" style="border-left-color: <?php echo $genderColor; ?>">
                <h3 class="title is-4 mb-2">
                    <i class="<?php echo $genderIcon; ?> mr-2" style="color: <?php echo $genderColor; ?>"></i>
                    Género Predicho
                </h3>
                <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $genderColor; ?>">
                    <?php echo $genderText; ?>
                </p>
            </div>

            <div class="stat-card" style="border-left-color: <?php echo $genderColor; ?>">
                <h3 class="title is-4 mb-2">
                    <i class="fas fa-percentage mr-2" style="color: <?php echo $genderColor; ?>"></i>
                    Probabilidad
                </h3>
                <p class="is-size-3 has-text-weight-bold mb-3" style="color: <?php echo $genderColor; ?>">
                    <?php echo $probability; ?>%
                </p>
                <div class="probability-bar">
                    <div class="probability-fill"
                        style="width: <?php echo $probability; ?>%; background: <?php echo $bgGradient; ?>">
                    </div>
                </div>
                <div class="confidence-level <?php echo $confidenceClass; ?>">
                    Confianza: <?php echo $confidenceLevel; ?>
                </div>
            </div>

            <?php if ($count > 0): ?>
                <div class="stat-card" style="border-left-color: <?php echo $genderColor; ?>">
                    <h3 class="title is-4 mb-2">
                        <i class="fas fa-database mr-2" style="color: <?php echo $genderColor; ?>"></i>
                        Datos Analizados
                    </h3>
                    <p class="is-size-4 has-text-weight-semibold">
                        <?php echo number_format($count); ?> registros
                    </p>
                    <p class="help">Número de personas con este nombre en la base de datos</p>
                </div>
            <?php endif; ?>

            <div class="has-text-centered mt-4">
                <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                    <i class="fas fa-redo mr-2"></i>
                    Probar otro nombre
                </button>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Animate probability bar
            const probabilityFill = document.querySelector('.probability-fill');
            if (probabilityFill) {
                probabilityFill.style.width = '0%';
                setTimeout(() => {
                    probabilityFill.style.width = '<?php echo $probability; ?>%';
                }, 500);
            }

            // Add click effect to stat cards
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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/library/template/style.css">
    <title>Resultados - Predicción de Edad</title>
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
    $url = "https://api.agify.io/?name=" . urlencode($name);

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

    if (!$data || !isset($data['age'])) {
        echo '<div class="error-container">
            <i class="fas fa-question fa-3x mb-3"></i>
            <h1 class="title has-text-white">Nombre no encontrado</h1>
            <p class="subtitle has-text-white">No pudimos determinar la edad para este nombre</p>
            <p>Es posible que sea un nombre muy poco común o no esté en nuestra base de datos.</p>
          </div>';
        exit();
    }

    // Process the data
    $age = $data['age'];
    $count = $data['count'] ?? 0;

    $ageCategory = "";
    $ageIcon = "";
    $ageColor = "";
    $bgGradient = "";
    $image = "";

    if ($age <= 18) {
        $ageCategory = "Joven";
        $ageIcon = "fas fa-child";
        $ageColor = "#4CAF50";
        $bgGradient = "linear-gradient(135deg, #4CAF50, #2196F3)";
        $image = "https://th.bing.com/th/id/R.1f0a31e41567f56253b489a2ed449a28?rik=jxXD1b6xUU%2fbDg&riu=http%3a%2f%2fcliparts.co%2fcliparts%2fLid%2foK5%2fLidoK5GBT.png&ehk=NeMJuJrj4oC5hGNsSgeTld%2b1NsQTD6h2TSTjC2V1O1I%3d&risl=&pid=ImgRaw&r=0";
    } elseif ($age > 18 && $age < 65) {
        $ageCategory = "Adulto";
        $ageIcon = "fas fa-user";
        $ageColor = "#2196F3";
        $bgGradient = "linear-gradient(135deg, #2196F3, #673AB7)";
        $image = "https://clipart-library.com/new_gallery/29-299411_13-of-original-size-people-no-background-cartoon.png";
    } elseif ($age >= 65) {
        $ageCategory = "Anciano";
        $ageIcon = "fas fa-user-graduate";
        $ageColor = "#673AB7";
        $bgGradient = "linear-gradient(135deg, #673AB7, #9C27B0)";
        $image = "https://www.pngitem.com/pimgs/m/219-2198289_elderly-cartoon-png-old-people-vector-png-transparent.png";
    } else {
        $ageCategory = "Indeterminado";
        $ageIcon = "fas fa-question";
        $ageColor = "#9E9E9E";
        $bgGradient = "linear-gradient(135deg, #9E9E9E, #757575)";
        $image = "";
    }

    ?>

    <script>
        document.body.style.background = '<?php echo $bgGradient; ?>';
    </script>

    <div class="result-container">
        <div class="result-header" style="background: <?php echo $bgGradient; ?>">
            <div class="icon">
                <i class="<?php echo $ageIcon; ?>"></i>
            </div>
            <h1 class="title is-2 has-text-white mb-2">¡Resultado Obtenido!</h1>
            <p class="subtitle is-5 has-text-white">Análisis completado con éxito</p>
        </div>

        <div class="result-body">
            <div class="stat-card" style="border-left-color: <?php echo $ageColor; ?>">
                <h3 class="title is-4 mb-2">
                    <i class="fas fa-user mr-2" style="color: <?php echo $ageColor; ?>"></i>
                    Nombre Analizado
                </h3>
                <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $ageColor; ?>">
                    <?php echo $name; ?>
                </p>
            </div>

            <div class="stat-card" style="border-left-color: <?php echo $ageColor; ?>">
                <h3 class="title is-4 mb-2">
                    <i class="<?php echo $ageIcon; ?> mr-2" style="color: <?php echo $ageColor; ?>"></i>
                    Edad Predicha
                </h3>
                <p class="is-size-3 has-text-weight-bold" style="color: <?php echo $ageColor; ?>">
                    <?php echo $age; ?> años (<?php echo $ageCategory; ?>)
                </p>
            </div>

            <?php if ($count > 0): ?>
                <div class="stat-card" style="border-left-color: <?php echo $ageColor; ?>">
                    <h3 class="title is-4 mb-2">
                        <i class="fas fa-database mr-2" style="color: <?php echo $ageColor; ?>"></i>
                        Datos Analizados
                    </h3>
                    <p class="is-size-4 has-text-weight-semibold">
                        <?php echo number_format($count); ?> registros
                    </p>
                    <p class="help">Número de personas con este nombre en la base de datos</p>
                </div>
            <?php endif; ?>

            <?php if ($image): ?>
                <div class="stat-card" style="border-left-color: <?php echo $ageColor; ?>">
                    <h3 class="title is-4 mb-2">
                        <i class="fas fa-image mr-2" style="color: <?php echo $ageColor; ?>"></i>
                        Imagen Representativa
                    </h3>
                    <figure class="image is-4by3">
                        <img src="<?php echo $image; ?>" alt="<?php echo $ageCategory; ?>">
                    </figure>
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
        document.addEventListener('DOMContentLoaded', function() {
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
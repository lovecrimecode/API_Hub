<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/library/template/style.css">
    <title>Resultados - Universidades por País</title>
</head>

<body>

    <?php
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';

    if (!$country) {
        echo '<div class="error-container">
            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error</h1>
            <p class="subtitle has-text-white">Debes ingresar un país válido</p>
            <p>Por favor, regresa y completa el formulario correctamente.</p>
          </div>';
        echo '<script>setTimeout(() => window.parent.location.reload(), 3000);</script>';
        exit();
    }

    $countryEncoded = urlencode(str_replace(" ", "+", $country));
    $url = "http://universities.hipolabs.com/search?country=" . $countryEncoded;

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

    if (empty($data)) {
        echo '<div class="error-container">
            <i class="fas fa-question fa-3x mb-3"></i>
            <h1 class="title has-text-white">No encontrado</h1>
            <p class="subtitle has-text-white">No se encontraron universidades para este país</p>
            <p>Verifica el nombre del país (en inglés) e intenta nuevamente.</p>
          </div>';
        exit();
    }

    $bgGradient = 'var(--neutral-gradient)';
    ?>

    <script>
        document.body.style.background = '<?php echo $bgGradient; ?>';
    </script>

    <div class="result-container">
        <div class="result-header" style="background: <?php echo $bgGradient; ?>">
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <h1 class="title is-2 has-text-white mb-2">¡Resultados Obtenidos!</h1>
            <p class="subtitle is-5 has-text-white">Universidades en <?php echo htmlspecialchars($country); ?></p>
        </div>

        <div class="result-body">
            <div class="table-container">
                <table class="table is-fullwidth is-striped is-hoverable">
                    <thead>
                        <tr>
                            <th>Universidad</th>
                            <th>Páginas Web</th>
                            <th>Dominios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $university): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($university['name']); ?></td>
                                <td>
                                    <?php foreach ($university['web_pages'] as $web): ?>
                                        <a href="<?php echo htmlspecialchars($web); ?>" target="_blank"><?php echo htmlspecialchars($web); ?></a><br>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($university['domains'] as $domain): ?>
                                        <a href="http://<?php echo htmlspecialchars($domain); ?>" target="_blank"><?php echo htmlspecialchars($domain); ?></a><br>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="has-text-centered mt-4">
                <button class="button is-primary is-rounded" onclick="window.parent.location.reload()">
                    <i class="fas fa-redo mr-2"></i>
                    Buscar otro país
                </button>
            </div>
        </div>
    </div>

</body>

</html>
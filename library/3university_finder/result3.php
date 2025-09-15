    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/library/template/style.css">

    <?php
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';

    if (!$country) {
        echo '<div class="error-container">
            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error</h1>
            <p class="subtitle has-text-white">Debes ingresar un país válido</p>
            <button class="button is-primary is-rounded mt-3" onclick="window.parent.document.getElementById(\'universityForm\').reset();">
                <i class="fas fa-redo mr-2"></i>
                Intentar de nuevo
            </button>
        </div>';
        exit();
    }

    $countryEncoded = urlencode(str_replace(" ", "+", $country));
    $url = "http://universities.hipolabs.com/search?country=" . $countryEncoded;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === FALSE || $httpCode !== 200) {
        echo '<div class="error-container">
            <i class="fas fa-wifi fa-3x mb-3"></i>
            <h1 class="title has-text-white">Error de conexión</h1>
            <p class="subtitle has-text-white">No se pudo conectar con el servicio</p>
            <p>Por favor, verifica tu conexión a internet e intenta nuevamente.</p>
            <button class="button is-primary is-rounded mt-3" onclick="window.parent.document.getElementById(\'universityForm\').reset();">
                <i class="fas fa-redo mr-2"></i>
                Intentar de nuevo
            </button>
        </div>';
        exit();
    }

    $data = json_decode($response, true);

    if (empty($data)) {
        echo '<div class="error-container">
            <i class="fas fa-question fa-3x mb-3"></i>
            <h1 class="title has-text-white">No encontrado</h1>
            <p class="subtitle has-text-white">No se encontraron universidades para "' . htmlspecialchars($country) . '"</p>
            <p>Verifica el nombre del país (en inglés, e.g., "United States") e intenta nuevamente.</p>
            <button class="button is-primary is-rounded mt-3" onclick="window.parent.document.getElementById(\'universityForm\').reset();">
                <i class="fas fa-redo mr-2"></i>
                Intentar de nuevo
            </button>
        </div>';
        exit();
    }

    $bgGradient = 'var(--neutral-gradient)';
    ?>
    <script>
        document.body.style.background = '<?php echo $bgGradient; ?>';
        window.parent.document.getElementById('resultsFrame').classList.add('loaded');
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
                                        <a href="<?php echo htmlspecialchars($web); ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($web); ?></a><br>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($university['domains'] as $domain): ?>
                                        <a href="http://<?php echo htmlspecialchars($domain); ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($domain); ?></a><br>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="has-text-centered mt-4">
                <button class="button is-primary is-rounded" onclick="window.parent.document.getElementById('universityForm').reset();">
                    <i class="fas fa-redo mr-2"></i>
                    Buscar otro país
                </button>
            </div>
        </div>
    </div>
    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Animate table rows
            const rows = document.querySelectorAll('.table tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = 0;
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    row.style.opacity = 1;
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });

        });
    </script>
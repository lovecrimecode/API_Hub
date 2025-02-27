<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$name = $_POST['name'];

if (!$_POST || !isset($_POST["name"])) {
    echo "Debes ingresar un nombre";
    exit();
}

$url = "https://api.agify.io/?name={$name}";

$response = file_get_contents($url);
$response = json_decode($response);

$image = "";

switch ($response->age) {
    case ($response->age <=18):
        $response->age = "Es joven (👶)";
        $image = "https://th.bing.com/th/id/R.1f0a31e41567f56253b489a2ed449a28?rik=jxXD1b6xUU%2fbDg&riu=http%3a%2f%2fcliparts.co%2fcliparts%2fLid%2foK5%2fLidoK5GBT.png&ehk=NeMJuJrj4oC5hGNsSgeTld%2b1NsQTD6h2TSTjC2V1O1I%3d&risl=&pid=ImgRaw&r=0";
        break;
    case ($response->age >18 && $response->age <65):
        $response->age = "Es adulto (🧑)";
        $image = "https://clipart-library.com/new_gallery/29-299411_13-of-original-size-people-no-background-cartoon.png";
        break;
    case ($response->age >=65):
        $response->age = "Es anciano (👴).";
        $image = "https://www.pngitem.com/pimgs/m/219-2198289_elderly-cartoon-png-old-people-vector-png-transparent.png";
        break;
    default:
        $response->age = "No se pudo determinar la edad.";
        break;
}

echo "<hr>";

echo "<div class='container'>";

echo "<h1 class='title result-title'>Resultados</h1>";

echo "<p>Nombre: {$name}</p>";

echo "<p>Edad: {$response->age}</p><br>";

echo "<img src='$image' alt='{$response->age}' width='80%' align='center'>";

echo "</div>";
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$city = $_POST['city'];

if (empty(trim($_POST['city'])) || !isset($_POST["city"])) {
     echo "Debes ingresar una ciudad de la Republica Dominicana.";
     exit();
}

$city = trim($_POST['city']);
$city = urlencode($city);


$url = "https://api.weatherapi.com/v1/current.json?key=8477ad31ff33421ba73220530252702&q={$city}&aqi=no";

$response = file_get_contents($url);
$response = json_decode($response);

if ($response->location->country != 'Dominican Republic') {
     echo "La ciudad ingresada no es valida.";
     exit();
}

//traducciones
if ($response->current->is_day == 1 && $response->current->condition->code == "1000") {
     $response->current->condition->text = "Soleado";
     echo '<style>body { background: url("https://media.istockphoto.com/id/1317255877/es/foto/agradable-fondo-de-panorama-cielo-azul-vac%C3%ADo-sin-nubes.jpg?b=1&s=170667a&w=0&k=20&c=_Gb8OuvK9gnIMHbAgn_WRUeRs2Bqjp4H9sk1iVok6Ms=") no-repeat center center fixed; background-size: cover; }</style>';
} else {
     $response->current->condition->text = "Despejado";
     echo '<style>body {background: url("https://zonaj.net/imgupload/Cielo-nocturno_tP2oHk.jpg")</style>")';
}

switch ($response->current->condition->code) {
     case ($response->current->condition->code == "1003"):
          $response->current->condition->text = "Parcialmente nublado";
          echo '<style>body { background: url("https://cdn.pixabay.com/photo/2018/08/01/10/09/clouded-sky-3576906_1280.jpg") no-repeat center center fixed; background-size: cover; }</style>';
          break; 
     case ($response->current->condition->code == "1006" || $response->current->condition->code == "1009"):
          $response->current->condition->text = "Nublado";
          echo '<style>body { background: url("https://cdn.pixabay.com/photo/2018/08/01/10/09/clouded-sky-3576906_1280.jpg") no-repeat center center fixed; background-size: cover; }</style>';
          break;          
     case ($response->current->condition->code == "1063" || $response->current->condition->code == "1150" || $response->current->condition->code == "1153"):
          $response->current->condition->text = "Lluvia ligera";
          echo '<style>body { background: url("https://static.vecteezy.com/system/resources/previews/000/432/454/non_2x/vector-background-with-rain-in-dark-sky.jpg") no-repeat center center fixed; background-size: cover; }</style>';
          break;
     case ($response->current->condition->code == "1180" || $response->current->condition->code == "1240"):
          $response->current->condition->text = "Lluvia moderada";
          echo '<style>body { background: url("https://static.vecteezy.com/system/resources/previews/000/432/454/non_2x/vector-background-with-rain-in-dark-sky.jpg") no-repeat center center fixed; background-size: cover; }</style>';
          break;
     case ($response->current->condition->code == "1183"):
          $response->current->condition->text = "Lluvia fuerte";
          echo '<style>body { backround: url("https://services.meteored.com/img/article/microfisica-de-nubes-y-formacion-de-la-lluvia-1670754813980_1280.jpeg") no-repeat center center fixed; background-size: cover; }</style>';
          break;
     case ($response->current->condition->code == "1186" || $response->current->condition->code == "1246"):
          $response->current->condition->text = "Lluvia torrencial";
          echo '<style>body { background: url("https://services.meteored.com/img/article/llegan-abundantes-lluvias-esta-semana-en-mexico-346871-1_1280.jpeg") no-repeat center center fixed; background-size: cover; }</style>';
          break;
     case ($response->current->condition->code == "1087"):
          $response->current->condition->text = "Tormenta electrica";
          echo '<style>body { background: url("https://th.bing.com/th/id/R.a36674f8f9ef2018a1b1dc60258e2e59?rik=OshwChuTEuoHww&pid=ImgRaw&r=0") no-repeat center center fixed; background-size: cover; }</style>';
          break;
     case ($response->current->condition->code == "1243"):
          $response->current->condition->text = "Lluvia moderada o fuerte";
          echo '<style>body { background: url("https://static.vecteezy.com/system/resources/previews/000/432/454/non_2x/vector-background-with-rain-in-dark-sky.jpg") no-repeat center center fixed; background-size: cover; }</style>';
          break;
}

echo "<hr>";

echo "<div class='container'>";

echo "<h1 class='title result-title'>Resultados</h1>";

echo "<p>Ciudad: {$response->location->name}</p>";

echo "<p>Temperatura: {$response->current->temp_c} grados Celcius</p><br>";

echo "<span class='icon-text'>
          <span class='icon'>
               <img src='{$response->current->condition->icon}' alt='weather icon'>
          </span>
          <span>Condicion: {$response->current->condition->text}</span>
     </span>";
//<img src='{$response->current->condition->icon}'> Condicion: {$response->current->condition->text}";

echo "</div>";
?>
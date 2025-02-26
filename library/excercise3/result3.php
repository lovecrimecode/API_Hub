<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$country = $_POST['country'];

if (!$_POST || !isset($_POST["country"])) {
    echo "Debes ingresar un pais valido";
    exit();
}

$url = "http://universities.hipolabs.com/search?country={$country}";

$response = file_get_contents($url);
$response = json_decode($response);


echo"
<hr>

<div class='container'>

<h1 class='title result-title'>Resultados</h1>

<ul>";
foreach ($response as $university) {
    echo"
    <li>Universidad: {$university->name}</li>
        <ul>
            <li>Web: {$university->web_pages[0]}</li>";
            foreach ($university->domains as $domain) {
                echo "<li>Dominios: {$domain}</li>";
            }
        echo "</ul>
    </li>";
}
echo "</ul>

</div>";
?>
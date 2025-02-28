<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

<?php
$page = $_POST['page'];
$icon = "";

switch ($page) {
     case "https://techcrunch.com/":
          $icon = "https://logos-world.net/wp-content/uploads/2023/03/TechCrunch-Logo-2005.png";
          break;
     case "https://www.nasa.gov/":
          $icon = "https://logodix.com/logo/32534.jpg";
          break;
     case "https://variety.com/":
          $icon = "https://download.logo.wine/logo/Variety_(magazine)/Variety_(magazine)-Logo.wine.png";
          break;
     case "https://www.rollingstone.com/":
          $icon = "https://download.logo.wine/logo/Rolling_Stone/Rolling_Stone-Logo.wine.png";
          break;
}

$page = $page . '/wp-json/wp/v2/posts?_fields=title,link,excerpt';
$posts = json_decode(file_get_contents($page), true); 

echo "<hr>";

echo "<div class='container'>";

echo "<img src='$icon' alt='Imagen no disponible' class='image' style='width: 100%; height: 100%;'>";
echo "<br>";

for ($i = 0; $i < 3; $i++) {
     $post = $posts[$i]; // Obtener el post actual
     echo "<h2 class='title'>{$post['title']['rendered']}</h2><br>";
     echo "<p>{$post['excerpt']['rendered']}</p><br>";
     echo "<a href='{$post['link']}' class='link'>Leer más</a><hr><br>";
 }
echo "</div>";
?>
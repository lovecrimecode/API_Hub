<?php
require('template.php');

function get_excercise($number)
{
     $excercises = get_excercises_list();
     return $excercises[$number] ?? null;
}

function get_excercises_list()
{
     $excercises = array(
          1 => array(
               'name' => 'Predicción de género',
               'description' => 'Predicción de género basándose en el nombre',
               'url' => '/library/1gender_prediction/',
               'icon' => 'fas fa-venus-mars' // Icon for gender, representing male/female symbols
          ),
          2 => array(
               'name' => 'Predicción de edad',
               'description' => 'Predicción de edad basándose en el nombre',
               'url' => '/library/2age_prediction/',
               'icon' => 'fas fa-birthday-cake' // Icon for age, symbolizing birth or aging
          ),
          3 => array(
               'name' => 'Universidades de un país',
               'description' => 'Búsqueda de Universidades por país',
               'url' => '/library/3university_finder/',
               'icon' => 'fas fa-university' // Icon for universities, representing education
          ),
          4 => array(
               'name' => 'Clima en República Dominicana',
               'description' => 'Consulta el clima actual en ciudades de RD',
               'url' => '/library/4rep_dom_weather/',
               'icon' => 'fas fa-cloud-sun' // Icon for weather, combining cloud and sun
          ),
          5 => array(
               'name' => 'Información de un Pokémon',
               'description' => 'Información detallada de cualquier Pokémon',
               'url' => '/library/5pokemon_info',
               'icon' => 'fas fa-star' // Icon for Pokémon, representing a Poké Ball or star-like quality
          ),
          6 => array(
               'name' => 'Noticias desde WordPress',
               'description' => 'Noticias recientes desde un sitio WordPress',
               'url' => '/library/6wordpress_news',
               'icon' => 'fas fa-newspaper' // Icon for news, representing articles
          ),
          7 => array(
               'name' => 'Conversión de Monedas',
               'description' => 'Conversor de monedas de dólar americano a peso dominicano',
               'url' => '/library/7money_converter',
               'icon' => 'fas fa-dollar-sign' // Icon for currency conversion, representing money
          ),
          8 => array(
               'name' => 'Generador de imágenes con IA',
               'description' => 'Genera imágenes a partir de descripciones textuales usando IA',
               'url' => '/library/8image_generator',
               'icon' => 'fas fa-image' // Icon for image generation, representing visuals
          ),
          9 => array(
               'name' => 'Datos de un país',
               'description' => 'Información detallada de cualquier país del mundo',
               'url' => '/library/9country_info',
               'icon' => 'fas fa-globe' // Icon for country data, representing the world
          ),
          10 => array(
               'name' => 'Generador de chistes',
               'description' => 'Chistes aleatorios en inglés',
               'url' => '/library/10joke_generator',
               'icon' => 'fas fa-laugh' // Icon for jokes, representing humor
          )
     );
     return $excercises;
}
?>
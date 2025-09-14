<?php
require ('template.php');
function get_excercise ($number) {
     $excercises = get_excercises_list($number);
     return $excercises[$number];
}

function get_excercises_list() {
     $excercises = array(
     1=> array(
          'name'=> 'Predicción de género',
          'description'=> 'Predicción de género basándose en el nombre👦👧',
          'url'=> '/library/1gender_prediction/',
     ),
     2=> array(
          'name'=> 'Predicción de edad',
          'description'=> '🎂',
          'url'=> '/library/2age_prediction/',
     ),
     3=> array(
          'name'=> 'Universidades de un país',
          'description'=> 'Búsqueda de Universidades por país',
          'url'=> '/library/3university_finder/',
     ),
     4=> array(
          'name'=> 'Clima en República Dominicana',
          'description'=> '🌞',
          'url'=> '/library/4rep_dom_weather/',
     ),
     5=> array(
          'name'=> 'Información de un Pokémon',
          'description'=> '⚡',
          'url'=> '/library/5pokemon_info',
     ),
     6=> array(
          'name'=> 'Noticias desde WordPress',
          'description'=> '📰',
          'url'=> '/library/6wordpress_news',
     ),
     7=> array(
          'name'=>'Ejercicio 7',
          'description'=> 'Conversión de Monedas💰',
          'url'=> '/library/excercise7',
     ),
     8=> array(
          'name'=>'Ejercicio 8',
          'description'=> 'Generador de imágenes con IA🖼️',
          'url'=> '/library/excercise8',
     ),
     9=> array(
          'name'=>'Ejercicio 9',
          'description'=> 'Datos de un país🌍',
          'url'=> '/library/excercise9',
     ),
     10=> array(
          'name'=>'Ejercicio 10',
          'description'=> 'Generador de chistes🤣',
          'url' => '/library/excercise10',
     )
);
return $excercises;
}

?>
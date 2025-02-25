<?php
require ('template.php');
function get_excercise ($number) {
     $excercises = get_excercises_list($number);
     return $excercises[$number];
}

function get_excercises_list() {
     $excercises = array(
     1=> array(
          'name'=>'Ejercicio 1',
          'description'=> 'Predicción de género👦👧',
          'url'=> '/library/excercise1/',
     ),
     2=> array(
          'name'=>'Ejercicio 2',
          'description'=> 'Predicción de edad🎂',
          'url'=> '/library/excercise2/',
     ),
     3=> array(
          'name'=>'Ejercicio 3',
          'description'=> 'Universidades de un país🎓',
          'url'=> '/library/excercise3',
     ),
     4=> array(
          'name'=>'Ejercicio 4',
          'description'=> 'Clima en República Dominicana🌞',
          'url'=> '/library/excercise4',
     ),
     5=> array(
          'name'=>'Ejercicio 5',
          'description'=> 'Información de un Pokémon⚡',
          'url'=> '/library/excercise5',
     ),
     6=> array(
          'name'=>'Ejercicio 6',
          'description'=> 'Noticias desde WordPress📰',
          'url'=> '/library/excercise6',
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
<?php

// Array Multidimensional con arrays vacíos
$my_array = array(
  'E1' => array(),
  'E2' => array()
);

var_dump($my_array);

// Array Multidimensional con arrays que si tienen datos
$my_array2 = array(
  'Jorge' => array(
    'fecha' => 1972,
    'banda'  => 'The Cure',
  ),
  'Pierre' => array(
    'fecha' => 1969,
    'fav_band' => 'Saint Germain',
  ),
);


// Añadir un elemento
$my_array2['Lucia'] = array(
  'fecha' => 1984,
  'banda' => 'The Beatles',
);

var_dump($my_array2);

// 1. Imprimir un elemento del array multidimensional
print $my_array2['Pierre']['fecha'];
print "<hr>";
print $my_array2['Lucia']['fecha'];

// 2. debug de un array dentro de otro array
print "<hr>";
var_dump($my_array2['Lucia']);

?>

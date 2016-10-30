<?php

// Inicializar un array con algunos datos

$comida = array(
  'saludable'=>array('ensalada','frutas'),
  'insaludable'=>array('pizza','mayonesa'));

// acceder a elementos usando el índice
echo $comida['saludable'][0]; echo '<br>';
echo $comida['insaludable'][1]; echo '<br>';

// Debuggear el contenido de un array

echo '<pre>';
print_r($comida);// var_dump($comida);
echo '</pre>';

// Asignar un valor a un índice de array
$comida['insaludable'][1] = 'tapas';

echo $comida['insaludable'][1];
?>

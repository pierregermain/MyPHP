<?php

// Inicializar un array con algunos datos

$comida = array('pizza','carne','pescado');

// acceder a elementos usando el índice
echo $comida[0];
echo $comida[1];
echo '<br>';

// Debuggear el contenido de un array

echo '<pre>';
print_r($comida);// var_dump($comida);
echo '</pre>';

// Asignar un valor a un índice de array
$comida[2] = 'tapas';

echo '<pre>';
var_dump($comida);
echo '</pre>';
?>

<?php

// Inicializar un array con algunos datos

$comida = array(
  'pizza'=>'lunes',
  'carne'=>'martes',
  'pescado'=>'miercoles');

// acceder a elementos usando el índice
echo $comida['carne'];
echo '<br>';
echo $comida['pescado'];
echo '<br>';

// Debuggear el contenido de un array

echo '<pre>';
print_r($comida);// var_dump($comida);
echo '</pre>';

// Asignar un valor a un array asociativo
$comida['pizza'] = 'jueves';

echo '<pre>';
print_r($comida);// var_dump($comida);
echo '</pre>';
?>

<?php

// Creación array
$frutas = array ('manzana','naranja','pera','fresa');

// ---------
// EJEMPLO 1
// ---------

// Tomamos una llave al azar
$llave = array_rand($frutas);
$fruta = $frutas[$llave];

// Comprobar valor.
// Guardamos resultado en $output
if ($fruta == 'manzana'){
  $output = 'es manzana';
}
elseif ($fruta == 'naranja'){
  $output = 'es naranja';
}
else{
  $output = 'es pera o fresa';
}

// Imprimimos $output ,algunas veces de forma mayuscula
// Curiosamente: Se puede acceder a $output 
// aunque se haya declarado dentro de un condicional if

$num = rand(0,1); // Numero al azar (0 o 1)
if ($num == 0)
  $output = strtoupper($output);

echo $output;

// ---------
// EJEMPLO 2
// Intercambio de valor - clave en array
// ---------

$adjetivos     = array ('buena','mala','excelente','flipante');
$exclamaciones = array ('!','.','!!','?!','?','??');

$adjetivo    = array_rand(array_flip($adjetivos));
$exclamacion = array_rand(array_flip($exclamaciones));

$output = 'Esta '. $fruta . ' es ' . $adjetivo . $exclamacion;

// Si el output tiene el signo '!'
// uso de RegEx
if (preg_match('/.*!.*/',$output))
  $output = strtoupper($output);

echo "<br>".$output;






?>

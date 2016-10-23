<?php

// Ejemplo 1

function nombre_funcion () {
  return 'hola mundo<br>';
}

echo nombre_funcion();


// Ejemplo 2

function add($a,$b){
  return $a+$b;
}

function div($a,$b){
  return $a/$b;
}

$x = 2;
$y = 4;

// ($x + $y)/ $x
echo div(add($x,$y),$x);
?>

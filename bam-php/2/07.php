<?php

// Funciones de array

// Es bueno ver todas las funciones que hay para manipular arrays
// http://php.net/manual/en/ref.array.php


$array_asociativo = array(
  'Pierre' => 1978,
  'Ely' => 1982,
  'Marc' => 1988,
);

echo "ORDENAR los valores (ascendentemente)\n";
asort($array_asociativo);
var_dump($array_asociativo);

echo "\nORDENAR los llaves (key)\n";
ksort($array_asociativo);
var_dump($array_asociativo);

echo "\nOBTENER elemento de forma random\n";
$elemento = array_rand($array_asociativo);
var_dump($elemento);

echo "\nQUITAR último elemento\n";
$elemento = array_pop($array_asociativo);
var_dump($elemento);

echo "\nContar Elementos del array\n";
$count = count($array_asociativo);
echo $count;


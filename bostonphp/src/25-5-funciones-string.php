<?php

// Recorte con rtrim
// Recortar espacios en blanco a la derecha

echo $string = " Esto es un ejemplo de String.      ";
echo '<br>';

echo $longitud = strlen($string);
echo '<br>';
echo '<br>';

echo $string = rtrim($string);
echo '<br>';

echo $longitud = strlen($string);
echo '<br>';
echo '<br>';

// Recorte con ltrim
// Recortar espacios en blanco a la derecha

echo $string = " Esto es un ejemplo de String. ";
echo '<br>';

echo $longitud = strlen($string);
echo '<br>';
echo '<br>';

echo $string = ltrim($string);
echo '<br>';

echo $longitud = strlen($string);
echo '<br>';
echo '<br>';
?>

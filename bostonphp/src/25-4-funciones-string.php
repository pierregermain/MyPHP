<?php

// Vamos a ver ejemplos para ver similitud entre Strings.

// Ejemplo 1
// Recortar espacios en blanco al princpio y al fin del String

echo $string = " Esto es un ejemplo de String. ";
echo '<br>';

echo $longitud = strlen($string);
echo '<br>';
echo '<br>';

echo $string = trim($string);
echo '<br>';

echo $longitud = strlen($string);
echo '<br>';
echo '<br>';

// Ejemplo 2
// Quitar carácteres desde el princpio y fin

echo $string = " XXX tiene un carácter en blanco al principio  pero no al final XXX";
echo '<br>';

// Esto no quita el 'Esto' ya que hay un carácter en blanco al principio
echo $string = trim($string,'XXX');
echo '<br>';
echo '<br>';

// Ejemplo 3
// Quitar carácteres desde el princpio y fin

echo $string = "XXX no tiene carácter blanco ni al principio ni al fin XXX";
echo '<br>';

// Esto no quita el 'Esto' ya que hay un carácter en blanco al principio
echo $string = trim($string,'XXX');
echo '<br>';
echo '<br>';

?>

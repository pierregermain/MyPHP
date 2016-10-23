<?php

echo $string = 'Esto es ! ejemplo de String. .';
echo '<br>';

// Contar palabras
echo str_word_count($string);
echo '<br>';
// Esto también cuanta palabras
echo str_word_count($string,0);
echo '<br>';

// Contar palabras incluyendo carácteres especiales
echo 'Contar con carácteres especiales ';
echo str_word_count($string,0,'.!');
echo '<br>';

// Producir un array cada elemento con 1 palabras
print_r (str_word_count($string,1));
echo '<br>';

// Producir un array, cada índice nos indica la posición de la palabra
print_r (str_word_count($string,2));
echo '<br>';

// Producir un array, cada índice nos indica la posición de la palabra
// Incluir además carácteres especiales
print_r (str_word_count($string,2,'.!'));
echo '<br>';

?>

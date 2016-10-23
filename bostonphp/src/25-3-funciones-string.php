<?php

// Vamos a ver ejemplos para ver similitud entre Strings.

// Ejemplo 1
echo $s1 = 'Hola, me llamo Pierre y estoy repasando la teoría de PHP.';
echo '<br>';
echo $s2 = 'Hey, soy Ely y estoy durmiendo ahora mismo en la cama que tengo mucho sueño';
echo '<br>';

similar_text($s1,$s2,$resultado);

echo $resultado.'<br><br>';

// Ejemplo 2

echo $s1 = 'Hola, me llamo Pierre y estoy repasando la teoría de PHP.';
echo '<br>';
echo $s2 = 'Hola, me llamo Pierre Willfried y estoy estudiando la PHP.';
echo '<br>';

similar_text($s1,$s2,$resultado);

echo $resultado.'<br><br>';

// Ejemplo 3

echo $s1 = 'Hola';
echo '<br>';
echo $s2 = 'Hola, me llamo Pierre Willfried y estoy estudiando la PHP.';
echo '<br>';

similar_text($s1,$s2,$resultado);

echo $resultado.'<br><br>';

// Ejemplo 4

echo $s1 = 'Hola, me llamo Pierre y estoy repasando la teoría de PHP.';
echo '<br>';
echo $s2 = 'Hola, me llamo Pierre W y estoy repasando la teoría PHP.';
echo '<br>';

similar_text($s1,$s2,$resultado);

echo $resultado.'<br><br>';
?>

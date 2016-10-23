<?php

echo $string = 'Esto es un ejemplo de String!';
echo '<br>';

// Mezclar los carácteres del string
// Cada vez que recargas la página te genera una nueva mezcla
echo str_shuffle($string);
echo '<br>';

// Generador de contraseñas
$pwd = '1234567890qwertyuiopasdfghjklzxcvbnm!@$%&*';
$pwd = str_shuffle($pwd);
echo $pwd.'<br>';

// Cortar un string desde la posición cero, de longitud 12
$pwd = substr($pwd,0,12);
echo $pwd;
echo '<br>';

// Obtener la longitud de un string
echo strlen($pwd);
echo '<br>';

// Cortar un string por la mitad desde la posición cero
$pwd = substr($pwd,0,strlen($pwd)/2);
echo $pwd;
echo '<br>';


?>

<?php

// Usuario de conexión
echo $user = "pierre";
echo '<br>';
// Inyección de SQL en el formulario
echo $password = " ' OR '2' = '2 ";
echo '<br>';

// Ejemplo de construcción de una query sin tener cuidado de inyección de código
echo $query = "SELECT * FROM user where user = '$user' AND pass = '$password'";
echo '<br>';

// Para evitar este tipo de inyecciones
// Uso de addslashes

$password = addslashes($password);
echo $password;
echo '<br>';

// Ejemplo de construcción de una query con addslashes
// lo que hace es añadir barras invertidas a los símbolos especiales
echo $query = "SELECT * FROM user where user = '$user' AND pass = '$password'";
echo '<br>';

// TODO Uso de html entities (se verá más adelante en el curso)
?>

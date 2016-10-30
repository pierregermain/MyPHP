<?php

// Usuario de conexión
echo $user = "pierre";
echo '<br>';
// Inyección de SQL en el formulario
echo $password = " ' OR '2' = '2 ";
echo '<br>';

// A) Ejemplo de construcción de una query sin tener cuidado de inyección de código
echo $query = "SELECT * FROM user where user = '$user' AND pass = '$password'";
echo '<br>';
echo '<br>';

// Para evitar este tipo de inyecciones
// Uso de addslashes

$password = addslashes($password);
echo $password;
echo '<br>';

// B) Ejemplo de construcción de una query con addslashes
// lo que hace es añadir barras invertidas a los símbolos especiales
echo $query = "SELECT * FROM user where user = '$user' AND pass = '$password'";
echo '<br>';
echo '<br>';

// C) Deshacer addslashes con stripslashes

$password = stripslashes($password);
echo $password;
echo '<br>';
echo '<br>';

// D) Uso de htmlentities para que no te guarde
// html puro

$string = "<strong> Hello</strong>";
echo $string;
echo '<br>';
echo htmlentities($string);
?>

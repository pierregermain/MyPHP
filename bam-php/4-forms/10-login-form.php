<?php

// Empezar un session
session_start();

// Array de mensajes
$mensajes = array();

// Array de usuarios
$usuarios = array(
  'admin' => '1234',
  'pierre' => '1978',
  'ely' => '1982',
);

// Comprobar si se ha enviado el form
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {

  case 'logout':
    session_destroy();
    session_start();
    $mensajes[] = "te has desconectado correctamente";
    break;

  case 'login':
    // Buscamos si el usuario/contraseña introducido en el form existe en nuestro array $usuarios
    foreach ($usuarios as $usuario => $pass) {
      if ($_POST['username'] == $usuario && $_POST['password'] == $pass) {
        // Asignamos variable de session
        $_SESSION['username'] = $usuario;
        break;
      }
    }
    // Miramos si se asignó variable de Sessión
    if (isset($_SESSION['username'])) {
      $mensajes[] = 'Te has conectado correctamente';
    }
    else {
      $mensajes[] = 'Comprueba tus creedenciales';
    }
    break;
  }
}


// Generamos el form para loggearnos.
// en el caso de no estar loggeados
// Ejemplo de uso de GET en la propia URL

if (isset($_SESSION['username'])){
  $mensajes[] = 'listo para desconectarte ?';
  $output = '
    <p> Bienvenido '. $_SESSION['username'] . '</p>
    <b><p> Ejemplo de method GET en la propia URL:<p>
    <p> <a href="10-login-form.php?action=logout"> Desconectarse</a></p></b>';
} else {
  $mensajes[] = 'listo para conectarte ?';
  $output = '
    <form action="10-login-form.php" method="post">
      <p>Usuario: <input type="text" name="username" /></p>
      <p>Contraseña: <input type="text" name="password" /></p>
      <p><input type="submit" value="Conectarse" /></p>
      <input type="hidden" name="action" value="login" />
    </form>';
}


// Mostrar Mensajes
// Ejemplo de uso de IMPLODE: Mete </li><li> cuando hay más de un elemento en el aray
$mensajes_output = '';
if (count($mensajes) > 0) {
  $mensajes_output = '
    <div>
      <ul><li>' . implode('</li><li>', $mensajes) . '</li></ul>
    </div>';
}

print $mensajes_output .'<hr>'. $output;

?>



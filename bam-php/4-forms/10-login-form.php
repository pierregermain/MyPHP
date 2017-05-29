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
    print 'logout';
    break;

  case 'login':
    print 'login';
    break;
  }

}


// Generamos el form para loggearnos.
// en el caso de no estarlo

if (isset($_SESSION['username'])){
  $mensajes[] = 'ya estás contectado :)';
  $output = '
  <p> Bienvenido ...</p>';
} else {
  $mensajes[] = 'no estás contectado :(';
  $output = '
  <form action="10-login-form.php" method="post">
    <p>Usuario: <input type="text" name="username" /></p>
    <p>Contraseña: <input type="text" name="password" /></p>
    <p><input type="submit" value="Conectarse" /></p>
    <input type="hidden" name="action" value="login" />
  </form>';
}


// Mostrar Mensajes
// Ejemplo de uso de IMPLODE
$mensajes_output = '';
if (count($mensajes) > 0) {
  $mensajes_output = '
    <div>
      <ul><li>' . implode('</li><li>', $mensajes) . '</li></ul>
    </div>';
}

print $mensajes_output .'<hr>'. $output;

?>



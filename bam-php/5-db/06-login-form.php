<?php

include('03-aux-conexion-db.php');

session_start();

$mensajes = array();

// Comprobar si se ha enviado el form
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {

  case 'logout':
    session_destroy();
    session_start();
    $mensajes[] = "te has desconectado correctamente";
    break;

  case 'login':
    // Buscamos si el usuario/contraseña introducido en el form existe en nuestra DB
    $query = "SELECT * FROM personas " . 
      "WHERE username = '" .
        mysqli_real_escape_string($mysqli,$_POST['username']).  "' " .
        "AND password = '" . 
        mysqli_real_escape_string($mysqli,$_POST['password']). "'";
    print ($query);
    $mysqli->real_query($query);
    $res = $mysqli->use_result();

    if ($row = $res->fetch_assoc()) {
        // Asignamos variable de session
        $_SESSION['username'] = $row['username'];
        break;
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
    <p> <a href="06-login-form.php?action=logout"> Desconectarse</a></p></b>';
} else {
  $mensajes[] = 'listo para conectarte ?';
  $output = '
    <form action="06-login-form.php" method="post">
      <p>Usuario: <input type="text" name="username" /></p>
      <p> Prueba metiendo MySql Injections:</p>
      <ul> 
        <li>usuario con una (\') comilla</li>
        <li>contraseña con: \' OR \'\'=\' </li>
      </ul>
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



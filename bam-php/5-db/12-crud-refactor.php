<?php
// Formulario para:
//  - Añadir persona
//  - Borrar persona
//  - Validar campos

// Obtenemos $mysqli
include ('03-aux-conexion-db.php');

// --------
// Mensajes
// --------

function notice ($text, $action = 'add_person') {
  static $notices;
  if ($action == 'add_person') {
    $notices[] = $text;
  }
  elseif ($action == 'get_person') {
    if (count($notices) > 0) {
      $output = array_to_list($notices);
      unset ($notices);
      return $output; 
    } 
  }
}

function array_to_list($array) {
  return '<ul><li>'.implode('<ul><li>',$array).'</li></ul>';
}

function get_notices() {
  return notice('','get_person');
}

// ---------------
// Mostar Personas
// ---------------

// Liga Borrar
function ligaBorrar($user){
    return '<a href="12-crud-refactor.php?action=delete&username='.$user.'"> Borrar</a>';
}
// Liga Actualizar
function ligaActualizar($user){
    return '<a href="12-crud-refactor.php?action=edit_form&username='.$user.'"> Actualizar</a>';
}

function people_display($mysqli) {

  $output = '';

  $query = 'SELECT nombre, anyo, banda, username, password FROM personas';
  $mysqli->real_query($query);
  $result = $mysqli->use_result();

  // Contenido de la tabla
  // @EJEMPLO Link de Delete en tabla
  while ($row = $result->fetch_assoc()) {
    $output .= '
    <tr>
      <td>'. $row['nombre'] . '</td>
      <td>'. $row['anyo'] . '</td>
      <td>'. $row['banda'] . '</td>
      <td>'. $row['username'] . '</td>
      <td>'. $row['password'] . '</td>
      <td>'. ligaBorrar($row['username']) . '</td>
      <td>'. ligaActualizar($row['username']) . '</td>
    </tr>';
  }


  // Header de la tabla
  if ($output != '') {
    $output = '
      <table>
        <tr>
          <th> Nombre </th>
          <th> Año </th>
          <th> Banda Favorita </th>
          <th> Username </th>
          <th> Password </th>
        </tr>
        ' . $output . '
      </table>';
  }
  else {
    $output = "<p>No hay datos que mostrar</p>";
  }
  $output = "<p><a href='12-crud-refactor.php?action=add_form'>Añadir persona</a></p>". $output;
  return $output;
}

// Obtenemos los valores introducidos anteriormente
// o los obtenemos de la DB
function add_form($mysqli, $username = NULL) {

  // Inicializamos $row para poder acceder a ellos sin errores desde nuestro form
  $row = array('nombre' => '',
               'anyo'   => '',
               'banda'   => '',
               'username'   => '',
               'password'   => '');

  // Inizializamos nuestro form cómo si fueramos a añadir una persona nueva
  $action = 'add_person';
  $username_input = '<p>Usuario: <input type="text" name="username" value="'.(isset($_POST['username']) ? $_POST['username']: '').'"/></p>';
  $edit_text = '';
  $submit_text = "Añadir Persona";

  // Pero si queremos actualizar una persona, cambiamos/inicializamos valores
  if ($username) {
    $action = 'edit_person';
    $submit_text = 'Actualizar Persona';
    $edit_text = '<p><strong>Estás editando:'.$username.'.</strong></p>';
    // Este campo esta a hidden cuando editamos un usuario
    // TODO: CUIDADO CON LOS HACKERS !!!
    $username_input = '<input type="hidden" name="username" value="'.$username.'"/>';
    $query = "SELECT nombre, anyo, banda, username, password FROM personas WHERE username = '" . mysqli_real_escape_string($mysqli,$username) . "'";
    notice($query);
    $res = $mysqli->query($query);
    $row = $res->fetch_assoc();
  }

  return '
    ' . $edit_text . '
    <form action="12-crud-refactor.php" method="post">
      <p> Nombre: <input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre']:$row['nombre']).'"/></p>
      <p> Año: <input type="number" name="anyo" value="' . (isset($_POST['anyo']) ? $_POST['anyo']:$row['anyo']).'"/></p>
      <p> Banda Favorita: <input type="text" name="banda" value="' . (isset($_POST['banda']) ? $_POST['banda']:$row['banda']).'"/></p>
      '. $username_input .'
      <p> Contraseña: <input type="text" name="password" value="' . (isset($_POST['password']) ? $_POST['password']:$row['password']).'"/></p>
      <p><input type="submit" value="'.$submit_text.'"/></p>
      <input type="hidden" name="action" value="'.$action.'"/>
    </form>';
}

// Inicializamos el output para no mostar la lista y el form a la vez
$output ='';

// Función para validar los campos introducidos
// TODO Generalizar
function validacion_campos($mysqli, $input, $action) {

  // Array que guarda los errores encontrados al validar los campos
  $errors = array();

  // No necesitamos en este caso espacios blancos
  foreach($input as $input_name => $value) {
    $input[$input_name] = trim($value);
  }

  print('<br>');
  var_dump($input);

  // Validación Campos Obligatorios
  $required = array('nombre','username','password');
  foreach($required as $input_name) {
    if ($input[$input_name] == '') {
      $errors[] = 'Falta introducir valor en ' . $input_name ; 
    }
  }

  // Validación Campo Numérico (Faltaría ver que sea de 4 caractéres)
  if (trim($input['anyo']) != '') {
    if(!is_numeric($input['anyo'])) {
      $errors[] = 'Falta introducir valor en el campo año';
    }
  } 

  // Validación campos Alfanumérico
  $alfanum = array('username','password');
  foreach ($alfanum as $input_name) {
    if (trim($input[$input_name]) != '') {
      if(!ctype_alnum($input[$input_name])) {
        $errors[] = 'Porfavor sólo introducir letras y/o números en el campo '. $input_name;
      }
    } 
  } 
  
  // Validación Campo Único
  // en el caso de ser una inserción
  // TODO Añadir más validaciones
  if ($action == 'add_person') {
    $mysqli->real_query("SELECT username FROM personas WHERE username = '"
      . $input['username'] . "'");
    $res = $mysqli->use_result();

    // Para cada resultado
    if ($row = $res->fetch_assoc()) {
      $errors[] = 'Una disculpa, el username ya existe. Porfavor usa otro';
    }
  }
  return $errors;
}

// Add/Edit Person
function add_edit_person($mysqli,$output,$action) {

  // Limpieza de valores
  // Metemos los valores en un array llamado $input
  $headers = array('nombre','anyo','banda','username','password');
  foreach ($headers as $key => $input_name) {
    $input[$input_name] = mysqli_real_escape_string($mysqli,$_POST[$input_name]);
  }
  var_dump($input);

  // Validación Campos
  $errores = validacion_campos($mysqli,$input,$action);

  // Dependiendo de la validación realizada
  if (count($errores) > 0) {
    notice('Hubo errores en la validación del formulario'.
      '<ul><li>'.implode('</li><li>',$errores).'</li></ul>');
    $output .= add_form($mysqli);
  }
  else{
    // Si estamos ante un INSERT
    if ($_REQUEST['action'] == 'add_person') {
      $values = "'" . implode("','", $input) . "'";
      $sql = "INSERT INTO personas (nombre, anyo, banda, username, password) VALUES (" . $values . ")";
    }
    // Si estamos ante un UPDATE
    else {
      $sql = "UPDATE personas
        SET nombre = '" . $input['nombre'] . "',
          anyo ='" . $input['anyo'] . "',
          banda ='" . $input['banda'] . "',
          password ='" . $input['password'] . "'
        WHERE username ='" . $input['username'] . "'";
    }

    notice($sql);

    $result = $mysqli->real_query($sql);

    if ($result == TRUE){
      // TODO: Mejorar mensaje para el update
      notice('Insertado dato desde el formulario');
    }
    else{
      notice('ERROR al insertar dato:'. mysqli_error($mysqli));
    }
  }

  // TODO Falta un break ???

}

// Función para borrar una persona
function borrar_persona($mysqli,$username){

      $username = mysqli_real_escape_string($mysqli,$username);
      $query = 
       "DELETE FROM personas 
        WHERE username = '". $username ."'";
      $mysqli->real_query($query);
      notice('El usuario ' . $username . ' fue borrado');
}

// Procesar el form
// @ REQUEST en vez de GET para poder acceder a $_POST
if (isset($_REQUEST['action'])) {

  switch ($_REQUEST['action']) {
    
    
  case 'delete':
      borrar_persona($mysqli,$_GET['username']);
      break;

   // @ Añadimos caso de edit/update 

    case 'edit_form':
    case 'add_form':
      // Pasamos Usuario en caso de tenerlo
      $output .= add_form($mysqli,isset($_GET['username']) ? $_GET['username'] : '');
      break;
    
    case 'edit_person':
    case 'add_person':
      $output .= add_edit_person($mysqli,$output,$_REQUEST['action']);
      break;

  }
}

print ('<p><a href="12-crud-refactor.php"> Home</a></p>');

// Sólo mostramos las personas si no tenemos un form creado
if ($output == ''){
  $output = people_display($mysqli);
}

print (get_notices().$output);
?>

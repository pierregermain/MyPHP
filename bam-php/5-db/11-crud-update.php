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

function notice ($text, $action = 'add') {
  static $notices;
  if ($action == 'add') {
    $notices[] = $text;
  }
  elseif ($action == 'get') {
    if (count($notices) > 0) {
      $output = '<ul><li>' 
        . implode ('</li><li>', $notices) 
        . '</li></ul>';
      unset ($notices);
      return $output; 
    } 
  }
}


function get_notices() {
  return notice('','get');
}

// ---------------
// Mostar Personas
// ---------------

// Liga Borrar
function ligaBorrar($user){
    return '<a href="11-crud-update.php?action=delete&username='.$user.'"> Borrar</a>';
}
// Liga Actualizar
function ligaActualizar($user){
    return '<a href="11-crud-update.php?action=actualizar&username='.$user.'"> Actualizar</a>';
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
  $output = "<p><a href='11-crud-update.php?action=add_form'>Añadir persona</a></p>". $output;
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
  $username_input = '<p>Username: <input type="text" name="username" value="'.(isset($_POST['username']) ? $_POST['username']: '').'"/></p>';
  $edit_text = '';
  $submit_text = "Añadir Persona";

  // Pero si queremos actualizar una persona, cambiamos/inicializamos valores
  if ($username) {
    $action = 'edit_person';
    $submit_text = 'Actualizar Persona';
    $edit_text = '<p><strong>Estás editando:'.$username.'.</strong></p>';
    // Este campo esta a hidden cuando editamos un usuario
    // CUIDADO CON LOS HACKERS !!!
    $username_input = '<input type="hidden" name="username" value="'.$username.'"/>';

    $result = $mysqli->query("SELECT nombre, anyo, banda, username, password FROM people WHERE username = '".mysql_real_escape_string($username)."'");
    $row = $result->fetch_assoc();

  }

  return '
    ' . $edit_text . '
    <form action="11-crud-update.php method="post">
      <p> Nombre: <input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre']:$row['nombre']).'"/></p>
      <p> Año: <input type="number" name="anyo" value="' . (isset($_POST['anyo']) ? $_POST['anyo']:$row['anyo']).'"/></p>
      <p> Banda Favorita: <input type="text" name="banda" value="' . (isset($_POST['banda']) ? $_POST['banda']:$row['banda']).'"/></p>
      <p> Usuario: <input type="text" name="username" value="' . (isset($_POST['username']) ? $_POST['username']:$row['username']).'"/></p>
      <p> Contraseña: <input type="text" name="password" value="' . (isset($_POST['password']) ? $_POST['password']:$row['password']).'"/></p>
      <p><input type="submit" value="'.$submit_text.'"/></p>
      <input type="hidden" name="action" value="'.$action.'"/>
    </form>';
}

// Inicializamos el output para no mostar la lista y el form a la vez
$output ='';

function validacion_campos($mysqli, $input) {

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
  // TODO Añadir más validaciones
  $mysqli->real_query("SELECT username FROM personas WHERE username = '"
    . $input['username'] . "'");
  $res = $mysqli->use_result();
  
  // Para cada resultado
  if ($row = $res->fetch_assoc()) {
    $errors[] = 'Una disculpa, el username ya existe. Porfavor usa otro';
  }
  return $errors;
}

// Add Person
function add_person($mysqli,$output) {

  // Limpieza de valores
  // Metemos los valores en un array llamado $input
  $headers = array('nombre','anyo','banda','username','password');
  foreach ($headers as $key => $input_name) {
    $input[$input_name] = mysqli_real_escape_string($mysqli,$_POST[$input_name]);
  }
  var_dump($input);

  // Validación Campos
  $errores = validacion_campos($mysqli,$input);

  // Dependiendo de la validación realizada
  if (count($errores) > 0) {
    notice('Hubo errores en la validación del formulario'.
      '<ul><li>'.implode('</li><li>',$errores).'</li></ul>');
    $output .= add_form($mysqli);
  }
  else{
    // TODO Ver si es INSERT O UPDATE

    // Metemos todos los valores al Insert
    $values = "'" . implode("','", $input) . "'";
    $sql = "INSERT INTO personas (nombre, anyo, banda, username, password) VALUES (" . $values . ")";

    notice($sql);

    $result = $mysqli->real_query($sql);

    if ($result == TRUE){
      notice('Insertado dato desde el formulario');
    }
    else{
      notice('ERROR al insertar dato:'. mysqli_error($mysqli));
    }
  }

  // TODO Falta un break ???

}

// Procesar el form
// TODO Cambiar GET por REQUEST
if (isset($_GET['action'])) {

  switch ($_GET['action']) {
    
    
    case 'delete':
      $username = mysqli_real_escape_string($mysqli,$_GET['username']);
      $query = 
       "DELETE FROM personas 
        WHERE username = '". $username ."'";
      $mysqli->real_query($query);
      notice('El usuario ' . $_GET['username'] . ' fue borrado');
      break;

   // TODO añadir caso de edit/update 

    case 'add_form':
      $output .= add_form();
      break;
    
    case 'add_person':
      $output .= add_person($mysqli,$output);
      break;

  }
}

print ('<p><a href="11-crud-update.php"> Home</a></p>');

// Sólo mostramos las personas si no tenemos un form creado
if ($output == ''){
  $output = people_display($mysqli);
}

print (get_notices().$output);
?>

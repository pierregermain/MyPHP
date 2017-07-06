<?php
// Añadimos funcionalidad de añadir una persona

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
    return '<a href="10-crud-validation.php?action=delete&username='.$user.'"> Borrar</a>';
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
  $output = "<p><a href='10-crud-validation.php?action=add_form'>Añadir persona</a></p>". $output;
  return $output;
}

// Obtenemos los valores introducidos anteriormente
function add_form() {
  return '
    <form action="10-crud-validation.php?action=add_person" method="post">
      <p> Nombre: <input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre']:'').'"/></p>
      <p> Año: <input type="number" name="anyo" value="' . (isset($_POST['anyo']) ? $_POST['anyo']:'').'"/></p>
      <p> Banda Favorita: <input type="text" name="banda" value="' . (isset($_POST['banda']) ? $_POST['banda']:'').'"/></p>
      <p> Usuario: <input type="text" name="username" value="' . (isset($_POST['username']) ? $_POST['username']:'').'"/></p>
      <p> Contraseña: <input type="text" name="password" value="' . (isset($_POST['password']) ? $_POST['password']:'').'"/></p>
      <p><input type="submit" value="Añadir"/></p>
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

  // Validación Campos Obligatorios
  $required = array('nombre','username','password');
  foreach($required as $input_name) {
    if (!in_array($input_name,$input)) {
      $errors[] = 'Falta introducir valor en ' . $input_name ; 
    }
  }

  // Validación Campo Numérico (Faltaría ver que sea de 4 caractéres)
  if (trim($input['anyo']) != '') {
    if(!is_numeric($input['anyo'])) {
      $errors[] = 'Falta introducir valor en el campo año';
    }
  } 

  // Validación campos Alfanumerico
  $alfanum = array('username','password');
  foreach ($alfanum as $input_name) {
    if (trim($input[$input_name]) != '') {
      if(!ctype_alnum($input[$input_name])) {
        $errors[] = 'Porfavor sólo introducir letras y/o números en le campo password';
      }
    } 
  } 
  
  // TODO Campos Único

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
    notice('Hubo errores en la validación del formulario');
    foreach ($errores as $key => $value){
      notice($value);
    }
    $output .= add_form($mysqli);
  }
  else{
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

}

// Procesar el form
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
    
    case 'add_form':
      $output .= add_form();
      break;
    
    case 'add_person':
      $output .= add_person($mysqli,$output);
      break;

  }
}

print ('<p><a href="10-crud-validation.php"> Home</a></p>');

// Sólo mostramos las personas si no tenemos un form creado
if ($output == ''){
  $output = people_display($mysqli);
}

print (get_notices().$output);
?>

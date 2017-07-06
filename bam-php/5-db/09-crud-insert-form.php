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
    return '<a href="09-crud-insert-form.php?action=delete&username='.$user.'"> Borrar</a>';
}

function people_display($mysqli) {

  $output = '';

  $query = 'SELECT nombre, anyo, banda FROM personas';
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
      <td>'. ligaBorrar($row['nombre']) . '</td>
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
        </tr>
        ' . $output . '
      </table>';
  }
  else {
    $output = "<p>No hay datos que mostrar</p>";
  }
  $output = "<p><a href='09-crud-insert-form.php?action=add_form'>Añadir persona</a></p>". $output;
  return $output;
}

// Form para dar de alta una persona
function add_form() {
  return '
    <form action="09-crud-insert-form.php?action=add_person" method="post">
      <p> Nombre: <input type="text" name="nombre" /></p>
      <p> Año: <input type="number" name="anyo" /></p>
      <p> Banda Favorita: <input type="text" name="banda" /></p>
      <p><input type="submit" value="Añadir" /></p>
    </form>';
}

// Inicializamos el output para no mostar la lista y el form a la vez
$output ='';

// Add Person
function add_person($mysqli) {

  // Limpieza de valores
  $headers = array('nombre','anyo','banda');
  foreach ($headers as $key => $input_name) {
    $input[$key] = mysqli_real_escape_string($mysqli,$_POST[$input_name]);
  }

  // Metemos todos los valores al Insert
  $values = "'" . implode("','", $input) . "'";
  $sql = "INSERT INTO kpersonas (nombre, anyo, banda) VALUES (" . $values . ")";

  notice($sql);

  $result = $mysqli->real_query($sql);

  if ($result == TRUE){
    notice('Insertado dato desde el formulario');
  }
  else{
    notice('ERROR al insertar dato:'. mysqli_error($mysqli));
  }

}

// Procesar el form
if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    
    
    case 'delete':
      $username = mysqli_real_escape_string($mysqli,$_GET['username']);
      $query = 
       "DELETE FROM personas 
        WHERE nombre = '". $username ."'";
      $mysqli->real_query($query);
      notice('El usuario ' . $_GET['username'] . ' fue borrado');
      break;
    
    case 'add_form':
      $output .= add_form();
      break;
    
    case 'add_person':
      add_person($mysqli);
      break;

  }
}

print ('<p><a href="09-crud-insert-form.php"> Home</a></p>');

// Sólo mostramos las personas si no tenemos un form creado
if ($output == ''){
  $output = people_display($mysqli);
}

print (get_notices().$output);
?>

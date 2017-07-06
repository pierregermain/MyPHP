<?php

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
    return '<a href="08-crud.php?action=delete&username='.$user.'"> Borrar</a>';
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
  return $output;
}

// Poblar datos iniciales en DB
// @CONSEJO Siempre es bueno usar comillas en los VALUES para protegernos de SQL Injections
function populate($mysqli){
    $query1 =
      "INSERT INTO `personas` (`nombre`, `anyo`, `banda`) VALUES ('Pierre','1978','ATCQ')";
    $query2 =
      "INSERT INTO `personas` (`nombre`, `anyo`, `banda`) VALUES ('Ely','1982','Nirvana')";
    $query3 =
      "INSERT INTO `personas` (`nombre`, `anyo`, `banda`) VALUES ('Marc','1988','Prince');";

    $mysqli->real_query($query1);
    $mysqli->real_query($query2);
    $mysqli->real_query($query3);
    notice('Insertado datos');
}

// Procesar el form
if (isset($_GET['action'])) {

  if ($_GET['action'] == 'delete') {
    $username = mysqli_real_escape_string($mysqli,$_GET['username']);
    $query = 
     "DELETE FROM personas 
      WHERE nombre = '". $username ."'";
    $mysqli->real_query($query);
    notice('El usuario ' . $_GET['username'] . ' fue borrado');
  }

  if ($_GET['action'] == 'populate') {
    populate($mysqli);
  }
}

print ('<p><a href="08-crud.php"> Home</a></p>');
print ('<p><a href="08-crud.php?action=populate"> Populate DB</a></p>');
print (get_notices());
print (people_display($mysqli));

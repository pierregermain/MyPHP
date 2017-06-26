<?php

print "<h1>Cliente de Mysql para PHP 7</h1>";

// Ejemplos adaptados para PHP 7
// phpinfo();

// Datos de Conexión
$server = 'localhost';
$user = 'root';
$pass = 'root';
$db   = 'bam';

// Crear Conexión
$mysqli = mysqli_connect($server, $user, $pass, $db);

// Mostar error si no hubo conexión
// @EJEMPLO die
if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// @EJEMPLO HACER QUERIES
// http://php.net/manual/en/mysqli.quickstart.statements.php
//
// -> real_query   : Si Hace store
// -> query        : No hace store

// EJEMPLO REAL QUERY
print ("<h2>EJEMPLO REAL QUERY</h2>");

$mysqli->real_query("SELECT * FROM personas");
$res = $mysqli->use_result();

$output = '';
// Para cada resultado
while ($row = $res->fetch_assoc()) {
  // Para cada columna
  foreach ($row as $key => $val) {
    $output .= $key . ' = ' . $val . '<br />';
  }
  $output .= '<br />';
}

print $output;


// EJEMPLO QUERY
print ("<h2>EJEMPLO QUERY</h2>");

$output = '';
$res = $mysqli->query("
  SELECT nombre,anyo 
  FROM personas 
  WHERE anyo > 1980
  ORDER BY anyo DESC"
);

$output = '';
while ($row = $res->fetch_assoc()) {
  foreach ($row as $key => $val) {
    $output .= $key . ' = ' . $val . '<br />';
  }
  $output .= '<br />';
}

print $output;

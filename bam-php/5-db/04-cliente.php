<?php

include ('03-aux-conexion-db.php');

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

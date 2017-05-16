<?php

// Importar funciones creadas
include ('06-parser-csv.php');

// Ejemplo de uso de función
$items = array();
$items[] = array(
  'Insitución' => 'TEC',
  'Sistema Operativo' => 'Windows',
);
$items[] = array(
  'Insitución' => 'Onixmedia',
  'Sistema Operativo' => 'OS X',
);
$items[] = array(
  'Insitución' => 'Factivs',
  'Sistema Operativo' => 'Linux',
);

print convertir_a_tabla($items);

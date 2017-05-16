<?php

// Separación de parser y impresión de registros
// Hacemos el programa más general para aceptar diferentes tipos de datos

// Función parser que obtiene el fichero y un array de labels más el separador de línea y registros
// Crea un array estandard

function parse_data($data_file, $array_labels, $record_divider = "\n", $data_divider = ",") {
  
  ob_start();
  include($data_file);
  $data = ob_get_contents();
  ob_end_clean();

  //Obtener los datos, meterlos en un array
  $data_array = explode($record_divider, $data);

  // Generalizamos nuestro bucle
  foreach ($data_array as $string) {
    $array = explode($data_divider, $string);
    // Debug
    echo '----<br>';
    foreach ($array as $key => $value) {
      $item[$array_labels[$key]] = trim($value); // Ejemplo: $item['anyo']= 1982;
      // Debug:
      echo $array_labels[$key].': ';
      echo $item[$array_labels[$key]].'<br>';
    }
    // Si realmente tenemos datos los metemos al array a ser devuelto
    if ($item['nombre'] != ''){
      $items[] = $item;
    }
  }

  return $items;
}

// Función que convierte los registros a tabla html

function convertir_a_tabla($items) {

  // Si no hay registros
  if (count($items) == 0) {
    return '<p> No hay datos que mostar </p>';
  }

  // Generar Cabecera de la tabla
  $cabecera_tabla = '';
  foreach ($items[0] as $header => $value) {
    $cabecera_tabla .= '<th>' . $header . '</th>';
  }
  $cabecera_tabla = '<tr>' . $cabecera_tabla . '</tr>';


  // Generar contenido de la tabla
  $contenido_tabla = '';
  foreach ($items as $item_array) {
    $fila = '';
    foreach ($item_array as $value) {
      $fila .= '<td>' . $value . '</td>';
    }
    $contenido_tabla .= '<tr>' . $fila . '</tr>';
  }

  $output = '<table>' . $cabecera_tabla . $contenido_tabla . '</table>';
  return $output;
}

// Nombre Fichero de texto
$data_file = 'data.txt';
// Columnas
$array_labels = array ('nombre', 'anyo', 'banda');
// Llamamos a las funciones creadas
$personas = parse_data($data_file, $array_labels);
print convertir_a_tabla($personas);


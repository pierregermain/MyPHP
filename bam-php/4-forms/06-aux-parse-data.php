<?php

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

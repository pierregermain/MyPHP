<?php

// Función parser que todavía tiene mucha lógica personalizada

function parse_data($data_file) {
  // Outputbuffer (ob)
  ob_start();
  include($data_file);
  // Get content of the ob
  $data = ob_get_contents();
  // Close de ob
  ob_end_clean();

  // Debug
  //die(var_dump($data));

  //Obtener los datos, meterlos en un array
  //Por cada salto de línea tendremos un elemento
  //Usamos la función explode para eso
  $personas_data_array = explode("\n", $data);

  // Debug
  //die(var_dump($personas_array));

  foreach ($personas_data_array as $personas_string) {
    $personas_array = explode(",", $personas_string);
    $nombre = trim($personas_array[0]);
    if ($nombre != ''){
      $anyo = trim($personas_array[1]);
      $banda = trim($personas_array[2]);
      $personas[$nombre] = array(
        'anyo' => $anyo,
        'banda' => $banda,
      );
    }
  }



  return $personas;
}

$personas = parse_data("data.txt");

// Debug
die(var_dump($personas));

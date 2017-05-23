<?php

// Función que convierte los registros a tabla html
// Ademas puede buscar frases en los registros

function convertir_a_tabla($items, $frase_buscar = '') {

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

    // Booleano para controlar las búsquedas
    // Cuando alguien no está buscando el booleano estará a TRUE
    // Cuando alguien si está buscando el booleano estará a FALSE
    $encontrado = ($frase_buscar != '') ? FALSE : TRUE;

    $fila = '';

    foreach ($item_array as $value) {
      $fila .= '<td>' . $value . '</td>';

      // Si se está buscando comprobar valor actual 
      if (!$encontrado){
        if (strstr($value, $frase_buscar)){
          $encontrado = TRUE;
        }
      }

    }

    // Imprimir si se ha encontrado
    if ($encontrado) {
      $contenido_tabla .= '<tr>' . $fila . '</tr>';
    }
  }

  $output = '<table>' . $cabecera_tabla . $contenido_tabla . '</table>';
  return $output;
}

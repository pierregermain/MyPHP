<?php

function empezar_sesion_aventura(){
  session_start();
  if (!isset($_SESSION['location'])){
    $_SESSION['location'] = 'casa';
    $_SESSION['inventario'] = array();
    }
}

function ejecutar_comando($comando) {

  // Ya no usamos variables globales

  $comandos_globales = array('reset', 'esperar', 'fumar');

  if (in_array($comando, $comandos_globales)) {
    switch ($comando) {

    case 'reset':
      session_destroy();
      empezar_sesion_aventura();
      // Ahora usamos función journal para los mensajes
      journal('Has reseteado el juego. Vuelves a estar en la casa');
      return;

    case 'esperar':
      journal('No se a que estás esperando chico!');
      return;

    }
  }

  $comando = strtolower($comando);
  // Posibles comandos en donde estamos ubicados
  $comandos = get_data_sitio_actual('comandos');

  // Debug
  print( '<p> comandos posibles:</p>');
  var_dump ($comandos);

  if (key_exists($comando, $comandos)) {
    //@EJEMPLO DE EVAL
    print( "<p>si existe comando</p>");
    // DEBUG SESSION
    var_dump($_SESSION);
    eval($comandos[$comando]);
  }
  else {
    print( "<p>no existe comando</p>");
    journal(get_data_sitio_actual('descripción'));
  }

}

// ---------
// FUNCIONES
// ---------

// Función para añadir/obtener los mensajes
function journal($text = '', $action = 'add'){
  //@EJEMPLO De static
  // El valor de variables estáticas persiste
  static $mensajes_array;

  if ($action == 'add') {
    $mensajes_array[] = $text;
  }
  elseif ($action == 'get') {

    if (count($mensajes_array) == 0) {
      journal(get_data_sitio_actual('descripción'));
    } 
    return '<ul><li>' . implode('</li><li>' , $mensajes_array) . '</li></ul>';
  }
}

//Función para facilitarnos en obtener los mensajes
function get_journal() {
  return journal('','get');
}

// Función para obtener el Inventario
function get_inventario(){

  // Renderizar inventario
  $inventario = '<p> No tienes objetos en tu inventario </p>';

  if (isset($_SESSION['inventario']) && count($_SESSION['inventario']) > 0 ) {
    $inventario = '<ul><li>' . implode('</li><li>', $_SESSION['inventario']) . '</li></ul>';
  }

  return '<h4>Inventario:</h4>' . $inventario;


}

// Función para obtener datos de un sitio desde fichero externo inc
function get_data_sitio($sitio) {
  // Para guardar los datos de los ficheros de sitos entre ejecuciones
  static $sitios;

  // Incluir el código si no tenemos los datos todavía
  if (!isset($sitios[$sitio])) {
    // Obtener $data
    include('sitios/' . $sitio . '.inc');
    // Asignar $data
    $sitios[$sitio] = $data;
  }

  return $sitios[$sitio];
}

// Función para obtener data del sitios actual
function get_data_sitio_actual($key = '') {

  $data_sitio = get_data_sitio($_SESSION['location']);

  if ($key == '') {
    return $data_sitio;
  }
  return $data_sitio[$key];
}

function  ir_hacia($sitio) {

  $_SESSION['location'] = $sitio;
  $data_sitio_actual = get_data_sitio_actual('descripción');
  journal($data_sitio_actual);

}

function recoger($objeto) {

  if(in_array($objeto, $_SESSION['inventario'])){
    journal('Oye, ya tienes ese objeto');
  } else {
    $_SESSION['inventario'][] = $objeto;
    journal('Has recogido el objeto');
  }
}

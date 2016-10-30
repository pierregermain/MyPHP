<?php

// Inicializar un array con algunos datos

$comida = array(
  'saludable'=>array('ensalada','frutas'),
  'insaludable'=>array('pizza','mayonesa'));

// acceder a elementos usando for each
// $comida va a ser $elemento
// $aray_interno serán los los arrays de $comida
foreach($comida as $elemento => $array_interno) {
  echo '<strong>'.$elemento.'</strong><br>';
  //echo $array_interno.'<br>';
  // Ahora recorremos cada array interno
  foreach($array_interno as $item) {
    echo $item.'<br>';
  }
}

?>

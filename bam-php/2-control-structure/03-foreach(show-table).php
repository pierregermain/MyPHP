<?php

// EJEMPLO 1

// arreglo
$arreglo = array ('uno','dos','tres','cuatro');

//foreach: $elemento va tomando el valor de cada elemento
foreach($arreglo as $elemento) {
  echo $elemento . "<br>";
}


// EJEMPLO 2
// Mostar datos cómo una tabla

// arreglo
$personas = array(
  'Pierre' => array(
    'año' => 1978,
    'banda' => 'ATQC',
  ),
  'Ely' => array(
    'año' => 1982,
    'banda' => 'Nirvana',
  ),
  'Marc' => array(
    'año' => 1988,
    'banda' => 'Mozart',
  ),
);

// Inicializamos la salida
$tabla = '';

       
// Rompemos desde el foreach el array en nombre y valor
foreach ($personas as $nombre => $detalles) {
  $tabla .= '
    <tr>
        <td>'. $nombre            . '</td>
        <td>'. $detalles['año']   . '</td>
        <td>'. $detalles['banda'] . '</td>
    </tr>';
}

// Creamos header si hay tabla. Imprimimos
if ($tabla != '') {
  echo $tabla = '
    <table>
      <tr>
        <th> Nombre </th>
        <th> Año </th>
        <th> Banda </th>
      </tr>
     ' . $tabla . '
     </table>';
}
else {
  echo $tabla = "<p> No hay datos que mostrar </p>";
}


?>

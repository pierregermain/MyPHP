<?php

// Importaciones
require("06-aux-parse-data.php");        // Leer Fichero
require("06-aux-convertir-a-tabla.php"); // Imprimir tabla

// OPERADOR TERNARIO
//
// Ejemplo:
//
// if ($input != '') {
//   $out == FALSE;
// }
// else {
//   $out == TRUE;
// }
//
// sería equivalente a 
//
// $out = ($input != '') ? FALSE : TRUE;
//

$frase_buscar = isset($_POST['frase']) ? $_POST['frase'] : '';

$fichero = 'fichero.txt';
$labels = array('nombre', 'fecha', 'banda');
$items = parse_data($fichero, $labels, "\n", ",");
print convertir_a_tabla($items, $frase_buscar); // Se le pasa la búsqueda

?>

<form action="06-search-form-y-operador-ternario.php" method="post">
  Buscar frase: 
  <input type="text" name="frase" value="<?php print $frase_buscar ?>" />
  <input type="submit" value="buscar" />
</form>




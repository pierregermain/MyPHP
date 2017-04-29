<?php

// -----------------------------
// 1. Ordenar array inversamente
// -----------------------------

echo "\n ------ Ejemplo 1 ------------- \n";
// Definición de array
$mi_array = array();
$mi_array[] = 'item1';
$mi_array[] = 'item2';
$mi_array[] = 'item3';
$mi_array[] = 'item4';

arsort($mi_array);
var_dump($mi_array);

// --------------------------------------
// 2. Usar funciones de arrays en objetos
// --------------------------------------

echo "\n ------ Ejemplo 2 ------------- \n";
// Definición de Objeto de array
$mi_objeto = new stdClass;
$mi_objeto->item1 = '0001';
$mi_objeto->item2 = '0002';
$mi_objeto->item3 = '0003';
$mi_objeto->item4 = '0004';

// Para usar las funciones de array
// en objetos podemos hacer casting
$casting = (array)$mi_objeto;

$total = count($casting);
echo $total."\n";

arsort($casting);
var_dump($casting);

// -------------------------------------
// 3. Uso de array_pop en nuestro Objeto
// -------------------------------------
//
// Tarea: Usar aray_pop en el siguiente 
// array multidimensional  para obtener 
// la persona de menor edad.
// Imprimir su banda favorita.

echo "\n ------ Ejemplo 3 ------------- \n";

$mi_array = array(
  'Marc' => array(
    'fecha' => 1988,
    'banda' => 'Prince',
  ),
  'Pierre' => array(
    'fecha' => 1978,
    'banda' => 'ATQC',
  ),
  'Ely' => array(
    'fecha' => 1982,
    'banda' => 'Nirvana',
  ),
);

var_dump($mi_array);

echo "\n------ Ordenar por defecto ------------- \n";
echo "------ Ordena por llave que sea int ------------- \n";

# Primero debemos ordenar el array por 'fecha'
asort($mi_array);

var_dump($mi_array);

echo "\n------ Ordenar arrays multidimensionales ------------- \n";
echo "------ elegimos por que llave ordenar ------------- \n";

# Creamos un array de fecha, que van a ser nuestros índices
$fecha = array();
foreach ($mi_array as $key => $row)
{
  $fecha[$key] = $row['fecha'];
  echo $fecha[$key]."\n";
}
array_multisort($fecha, SORT_ASC, $mi_array);

echo "\n --- Quitamos el último elemento ---\n";
array_pop($mi_array);
var_dump($mi_array);

// ----------------------------------------------
// 4. Ejercicio Obtner elementos random de array
// ----------------------------------------------
//
// Tarea: Tomar Nombre random de array 
// Devolver "Hola nombre-random-de-array"

$llave = array_rand($mi_array,1);


echo "Hola ". $llave . ", cómo estás ?" ;

var_dump ($mi_array[$llave]);

<?php

// -----------------------------
// 1. Ordenar array inversamente
// -----------------------------

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
// Tarea: Usar aray_pop en el siguiente objeto
// para obtener la persona de menor edad.
// Imprimir su banda favorita

echo "\n";

$mi_objeto = new stdClass;
$mi_objeto->Marc = new stdClass;
$mi_objeto->Pierre = new stdClass;
$mi_objeto->Ely = new stdClass;

$mi_objeto->Marc->anyo = 1988;
$mi_objeto->Ely->anyo = 1982;
$mi_objeto->Pierre->anyo = 1978;

$mi_objeto->Marc->banda = 'Prince';
$mi_objeto->Ely->banda = 'Nirvana';
$mi_objeto->Pierre->banda = 'ATCQ';


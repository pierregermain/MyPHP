<?php

// Objetos tipo Array
// No es lo mismo acceder a Objetos que a Arrays
// Esto se usa mucho en drupal

// Por ejemplo las entidades de Usuarios y los Nodos 
// en Drupal usan esta estructura

// Ejemplo 1

// Creación de un Objeto Genérico
// http://php.net/manual/en/language.types.object.php#language.types.object.casting
// Dicho objeto va ser nuestro Array Asociativo
$mi_objeto = new stdClass;

// Dar de alta elementos
$mi_objeto->Marc = 1988;
$mi_objeto->Pierre = 1978;
$mi_objeto->Ely = 1982;

// Acceder a elementos
echo $mi_objeto->Marc;
echo '<br>';

// Ejemplo 2
// Creación de un Objeto multidimensional

$mi_objeto = new stdClass;

// Dar de alta objetos dentro de otro objeto
$mi_objeto->Marc = new stdClass;
$mi_objeto->Pierre = new stdClass;
$mi_objeto->Ely = new stdClass;

// Dar de alta elementos en el objeto multidimensional
$mi_objeto->Marc->anyo = 1988;
$mi_objeto->Marc->banda = 'Prince';
$mi_objeto->Marc->color = 'azul';

$mi_objeto->Ely->anyo = 1982;
$mi_objeto->Ely->banda = 'Nirvana';
$mi_objeto->Ely->color = 'rojo';

$mi_objeto->Pierre->anyo = 1978;
$mi_objeto->Pierre->banda = 'ATCQ';
$mi_objeto->Pierre->color = 'verde';

// Acceder a elementos
echo $mi_objeto->Marc->anyo;
echo '<br>';
echo $mi_objeto->Ely->banda;
echo '<br>';
echo $mi_objeto->Pierre->color;
echo '<br>';

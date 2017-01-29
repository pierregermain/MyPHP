<?php
$string = 'Esto es un string';

$exp1 = '/un/';
$exp2 = '/una/';

$exp2 = '/una/';

// preg_match nos dice si cierta expresion regular se cumple devolviendo 1 o 0

//Ejemplo 1

if (preg_match($exp1,$string)){
  echo 'encontrado<br>';
}
else{
  echo 'no encontrado';
}

//Ejemplo 2

if (preg_match($exp2,$string)){
  echo 'encontrado';
}
else{
  echo 'no encontrado<br>';
}
?>

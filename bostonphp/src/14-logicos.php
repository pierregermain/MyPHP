<?php

$max = 1000;
$min = 500;

// Hacer pruebas con este valor
$num = 599;

// AND
// a la antigua
if ($num > $min AND $num < $max){
  echo 'O';
}

// a la nueva
if ($num > $min && $num < $max){
  echo 'K';
}

// OR
// a la antigua
if ($num == $min OR $num == $max){
  echo 'oh';
}

// a la nueva
if ($num == $min || $num == $max){
  echo 'key';
}

// NOT
if (!($num == 599)){
  echo ',it is not 599';
}
else {
  echo ',it is 599';
}

?>

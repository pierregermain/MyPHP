<?php

$num = 3;

// Ejemplo 1 sin default
switch ($num) {

  case 2:
    echo 'dos';
  break;

  case 3:
    echo 'tres<br>';
  break;

  case 4:
    echo 'cuatro';
  break;
}

// Ejemplo 2 con default
switch ($num) {
  case 1:
    echo 'uno';
  break;

  case 2:
    echo 'dos';
  break;

  default:
    echo 'no encontrado<br>';
  break;
}

// Ejemplo 3 sin break
switch ($num) {
  case 2:
  case 3:
    echo 'es dos o tres';
  break;

  default:
    echo 'no encontrado';
  break;
}
?>

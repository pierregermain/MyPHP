<?php

$num1 = '1';//esto es un string
$num2 = 1;  //esto es un int

// Comparación de valores
// usando casting automático
if ($num1 == $num2){
  echo "'$num1' y $num2 SI son iguales usando ==<br>";// este se ejecuta
}
else{
  echo "'$num1' y $num2 no son iguales usando ==";
}

// Comparación de valores
// no usando casting automático
if ($num1 === $num2){
  echo "'$num1' y $num2 son iguales usando ===";
}
else{
  echo "'$num1' y $num2 NO son iguales usando ===";// este se ejecuta
}
?>

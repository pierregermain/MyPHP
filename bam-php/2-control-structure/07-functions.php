<?php

function f_simple(){
  $hola = "hola mundo";
  return $hola;
}

function f_param($var1, $var2) {
  $hola = $var1." ".$var2;
  return $hola;
}


function f_def_value($var1 = "hey", $var2 = "apache") {
  $hola = $var1." ".$var2;
  return $hola;
}

echo "Función simple: <br>";
echo f_simple();
echo "<br>";

echo "<br> Función con Parámetros: <br>";
echo f_param("saludos","drupaleros");
echo "<br>";

echo "<br> Función con Valores por defecto: <br>";
echo f_def_value();
echo "<br>";

echo "<br> Función con Valores por defecto al que si le paso valores: <br>";
echo f_def_value("Hola","Amigos del PHP");
echo "<br>";

<?php

function f_simple(){
  $hola = "hola mundo";
  return $hola;
}

function f_param($var1, $var2) {
  $hola = $var1." ".$var2;
  return $hola;
}

function f_param_reference(&$var) {
  $var = "Valor cambiado";
  return $var;
}

function f_def_value($var1 = "hey", $var2 = "apache") {
  $hola = $var1." ".$var2;
  return $hola;
}

echo "<h3>Función simple: </h3>";
echo f_simple();

echo "<h3> Función con Parámetros: </h3>";
echo f_param("saludos","drupaleros");

echo "<h3> Función con Parámetros por referencia: </h3>";
echo $hola = "Valor Original";
echo "<br>";
f_param_reference($hola);
echo $hola;

echo "<h3>Función con Valores por defecto: </h3>";
echo f_def_value();

echo "<h3> Función con Valores por defecto al que si le paso valores: </h3>";
echo f_def_value("Hola","Amigos del PHP");

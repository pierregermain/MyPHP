<?php

// 1. Mostar número de chars borrados con trim
$rista = 'Hola me llamo Pierre    y hay espacios en blanco     ';
$long_inicial = strlen($rista);

$rista = trim($rista);
$long_final = strlen($rista);

$espacios_quitados = $long_inicial - $long_final;

echo $espacios_quitados;

// 2. Poner en mayúscula la primera letra de cada palabra sin quitar el <strong>
echo "<hr>";

$frase = "THIS IS A <strong>STRING STRING _STRING</strong> EXAMPLE.";
echo $frase;
$frase = ucwords(strtolower($frase),"> _");
echo $frase;

// 3. Mostrar la fecha May 24th, 2010
echo "<hr>";

$anyo = 2010;
$mes = 5;
$dia = 24;
$fecha = mktime(0,0,0,$mes,$dia,$anyo);
echo date("F dS, Y",$fecha);

// 4. Quitar el punto al final con trim
echo "<hr>";

$rista = "Frase con un punto (.) al final.";
$rista = trim($rista,".");
echo $rista;

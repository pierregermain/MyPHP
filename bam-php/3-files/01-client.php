<?php

// Ejemplos de include
// 0 por defecto
$ejemplo = 0;

// Obtenemos las variables con include / include_once
switch ($ejemplo) {
    case 0:
        echo "include normal."."<br>";
        include('05-data.php');
        break;
    case 1:
        echo "include once (sólo se ejecutaría una vez)."."<br>";
        include_once('05-data.php');
        break;
    case 2:
        echo "include desde el padre..."."<br>";
        include_once('../05-data.php');
        break;
    case 3:
        echo "include desde la raiz..."."<br>";
        include_once('/05-data.php');
        break;
}

var_dump($personas);

<?php

// Empezar un session
session_start();

// Crear una variable de SESSION
$_SESSION['refresh_log'][] = 'Has refrescado esta página a las '. date('H:i:s').' horas';

// Mostar el log de refresh, ordenados desendientemente
$log = array_reverse($_SESSION['refresh_log']);
foreach ($log as $valor) {
  print '<p>' . $valor . '</p>';
}
?>

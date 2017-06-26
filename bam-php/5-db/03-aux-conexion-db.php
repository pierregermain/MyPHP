<?php

// Datos de Conexión
$server = 'localhost';
$user   = 'root';
$pass   = 'root';
$db     = 'bam';

// Crear Conexión
$mysqli = mysqli_connect($server, $user, $pass, $db);

// Mostar error si no hubo conexión
// @EJEMPLO die
if ($mysqli->connect_errno) {
    die( "Error al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

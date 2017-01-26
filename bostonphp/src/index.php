<?php
echo '<strong>hola mundo</strong>';

// Listado de Ficheros
$directorio = '.';
$ficheros  = scandir($directorio);

foreach($ficheros as $phpfile)
{
echo "<a href=$phpfile>".basename($phpfile)."</a><br>";
}

?>

<?php

// See http://php.net/manual/en/ref.strings.php for all string functions. Or Google 'php string functions'.

$variable = "  This is a 
  <strong>string</strong> example.  ";
print $variable;
print "<hr>";

// Returns FALSE if the string does not exists.
$recorte = strstr($variable, 'example');
print $recorte;
print "<hr>";

// Convert new lines to <br /> tags.
$saltolinea = nl2br($variable);
print $saltolinea;
print "<hr>";

// Quitar espacio en blanco
$quitaespacio = trim($variable);
print $quitaespacio;
print "<hr>";

// Return the length of the string.
$long = strlen($variable);
print $long;
print "<hr>";
print "<hr>";

// Replace one part of the string with another.
// Cambiar en $variable el texto example por party
$reemplazar = str_replace('example', 'party', $variable);
print $reemplazar;
print "<hr>";

// Quitar HTML
$txt = strip_tags($variable);
print $txt;
print "<hr>";

// Covert all the characters to uppercase.
$upper = strtoupper($variable);
print $upper;

print "<hr>";
print "<hr>";
// Capitalize each word. no lo hace dentro del HTML
$capitalize = ucwords($variable);
print $capitalize;
print "<hr>";

// Return the date. 
$fecha = date('F j, Y');
print $fecha;
print "<hr>";


// Return the date de ayer
$segundos_en_un_dia = 24*60*60;
$fecha = date('F j, Y', time() - $segundos_en_un_dia);
print $fecha;
print "<hr>";

// Ver doc's de php, con ejemplo de la función date
// http://php.net/manual/en/function.date.php

?>

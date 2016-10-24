<p>Ejemplo 1: Sin PHP:</p>

<input type="text" name="name"><br>

<p>Ejemplo 2: Con PHP:</p>

<?php

// Ejemplo 2.1: Comillas Simples
// Usar comillas simples es más rápido para el intérprete
echo '<input type="text" name="name">';

echo '<br>';

// Ejemplo 2.2: Comillas dobles
// Usar comillas dobles más lento para el intérprete
echo "<input type=\"text\" name=\"name\">";

?>

<p>Ejemplo 3: Uso de Variables dentro del html</p>

<?php
$text = 'Hola Mundo';
?>

<input type="text" value="<?php echo $text; ?>">

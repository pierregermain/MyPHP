Sin PHP:

<input type="text" name="name"><br>

Con PHP:

<?php

// Usar comillas simples es más rápido para el intérprete
echo '<input type="text" name="name">';

echo '<br>';

// Usar comillas dobles más lento para el intérprete
echo "<input type=\"text\" name=\"name\">";

?>

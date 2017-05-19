<?php
// Usamos comentarios PHP para que no aparezcan en el código fuente HTML

// Definimos el Form
// Le decimos que vamos a hacer submit contra este mismo fichero
//
// Método GET: Mete los parámetros en el URL posterior al "?"
//   Más fácil de debuggear
?>

<form action="01-form-get.php" method="get">
  Mi Rista: <input type="text" name="my_string" />
  <input type="submit" value="Mostrar mi rista" />
</form>

<?php

// Obtención del String e impresión
// Lo obtenemos del array $_GET
// Miramos si realmente existe el parámetro
if (isset($_GET['my_string'])) {
  print '<h1> Mi String es: ' . $_GET['my_string'] . '</h1>';
}

?>





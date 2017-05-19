
<h1> Ejemplo de Form con POST </h1>

<form action="02-form-post.php" method="post">
  Mi Rista: <input type="text" name="my_string" />
  <input type="submit" value="Imprimir mi string" />
  <input type="hidden" name="action" value="mi-rista-action" />
</form>

<?php

// Para acceder a las variables mandadas con POST
// accedemos al array $_REQUEST
if (isset($_REQUEST['action'])) {

  // Y ahora miramos si realmente tenemos el action correcto
  if($_REQUEST['action'] == 'mi-rista-action'){
    // Imprimimos la variable $_POST
    print 'Mi Rista es: <strong>' . $_POST['my_string'] . '</strong>';
  } 

}

?>

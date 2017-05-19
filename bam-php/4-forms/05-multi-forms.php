<?php

$my_string = '';

if(isset($_REQUEST['action'])) {

  switch ($_REQUEST['action']) {

    case 'mostrar':
      print '<h3>Mi string es: '. $_POST['my_string'] . '</h3>';
      break;

    case 'guardar':
      $my_string = $_GET['mi_rista'];
      print '<h3>Mi string '. $my_string . ' no se borró</h3>';
      break;
    }
}
?>

<form action="05-multi-forms.php" method="post">
  Mi Rista: <input type="text" name="my_string" />
  <input type="submit" value="Imprimir mi string" />
  <input type="hidden" name="action" value="mostrar" />
</form>

<form action="05-multi-forms.php" method="get">
  Esta rista no va a desaparecer: 
  <input type="text" name="mi_rista" value="<?php print $my_string; ?>" />
  <input type="submit" value="Guarda mi rista" />
  <input type="hidden" name="action" value="guardar" />
</form>


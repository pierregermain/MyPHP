<h3> Ejemplo de cómo no borrar los datos al hacer submit</h3>
<?php
$my_string = '';

var_dump($_REQUEST);
print '<hr>';

if ((isset($_REQUEST['action']))
  && ($_REQUEST['action'] == 'guardar')){

  $my_string = $_GET['mi_rista'];
  print '<p> Mi rista <strong>'.$_GET['mi_rista'].'</strong> no se borró</p>';

}

?>
<form action="04-form-save-input.php" method="get">
  Esta rista no va a desaparecer: 
  <input type="text" name="mi_rista" value="<?php print $my_string; ?>" />
  <input type="submit" value="Guarda mi rista" />
  <input type="hidden" name="action" value="guardar" />
</form>






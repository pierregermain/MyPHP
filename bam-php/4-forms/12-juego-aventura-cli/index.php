<?php

// index.php 
// ya no necesitamos poner el fichero en el URL
// @EJEMPLO FICHERO INC
// con el navegador abrimos un fichero .inc
// se va a abrir cómo fichero de texto
// lo malo es que el usuario de la web podría ver el contenido
include('funciones.inc');

// Inicializar sessión
empezar_sesion_aventura();

// Si el Usuario mete un comando ejecutarlo
if (isset($_POST['comando'])){

  // Debug
  echo '<p>$_POST: '; var_dump($_POST); echo '</p>';
  echo '<p>$_POST["comando"]: '; var_dump($_POST['comando']); echo '</p>';

  ejecutar_comando($_POST['comando']);
}

?>

<h1> Juego de Aventuras por texto </h1>

<h3> Mapa: </h3>
<p> Para resetear escribe <em>reset</em> </p>
<p> Para ver escribe <em>ver</em> </p>

<div>
  <div style="display:inline-block;width:100px;height:100px;border:1px solid #000;">Casa</div>
  <div style="display:inline-block;margin:10px"></div>
  <div style="display:inline-block;width:100px;height:100px;border:1px solid #000;">Terraza</div>
</div>
<div style="margin:10px"></div>
  <div>
  <div style="display:inline-block;width:100px;height:100px;border:1px solid #000;">Jardín</div>
  <div style="display:inline-block;margin:10px"></div>
  <div style="display:inline-block;width:100px;height:100px;border:1px solid #000;">Lago</div>
</div>
<br>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
  Tu comando: <input type="text" name="comando" />
  <input type="submit" value="Hazlo" />
</form>
<div>
  <?php print get_journal(). get_inventario(); ?> 
</div>

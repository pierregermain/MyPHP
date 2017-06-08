<?php

empezar_sesion_aventura();

// Para guardar los comandos que podemos hacer en cada mundo
$data = array();
// Para mostar los mensajes por la terminal web
$mensajes_array = array();

// Inicializamos variables globales que
// nos dicen donde estamos y que objetos tenemos

function empezar_sesion_aventura(){
  session_start();
  if (!isset($_SESSION['location'])){
    $_SESSION['location'] = 'Casa';
    $_SESSION['inventario'] = array();
    }
}

function ejecutar_comando($comando) {

  // EJEMPLO DE GLOBAL
  global $data;
  global $mensajes_array;
  global $texto_estandard;

  $comandos_globales = array('reset', 'esperar', 'fumar');

  if (in_array($comando, $comandos_globales)) {
    switch ($comando) {

    case 'reset':
      session_destroy();
      empezar_sesion_aventura();
      $mensajes_array[] = 'Has reseteado el juego. Vuelves a estar en la Casa';
      return;

    case 'esperar':
      $mensajes_array[] = 'No se a que estás esperando chico!';
      return;

    case 'fumar':
      //log_standard_text('malo');//TODO
      return;
    }
  }

  $comando = strtolower($comando);
  // Posibles comandos en donde estamos ubicados
  $comandos = $data[$_SESSION['location']]['comandos'];

  // Debug
  print( '<p> comandos posibles:</p>');
  var_dump ($comandos);

  if (key_exists($comando, $comandos)) {
    // EJEMPLO DE EVAL
    print( "<p>si existe comando</p>");
    // DEBUG SESSION
    var_dump($_SESSION);
    eval($comandos[$comando]);
  }
  else {
    //log_standard_text('no');//TODO
    print( "<p>no existe comando</p>");
    $mensajes[] = $data[$_SESSION['location']]['descripción'];
  }

}

// ---------
// FUNCIONES
// ---------
function  ir_hacia($sitio) {
  global $data;
  global $mensajes_array;

  $_SESSION['location'] = $sitio;
  $mensajes_array[] = $data[$sitio]['descripción'];

}

function recoger($objeto) {

  global $mensajes_array;

  if(in_array($objeto, $_SESSION['inventario'])){
    $mensajes_array[] = 'Oye, ya tienes ese objeto';
  } else {
    $_SESSION['inventario'][] = $objeto;
    $mensajes_array[] = 'Has recogido el objeto';
  }
}

// --------------
// ARRAY DE DATOS
// --------------

// Array de datos
// los comandos deben estar en minúsculas
$data['Casa'] = array(
  'descripción' => 'Estás en la casa. Hay una puerta al Este y una ventana al Sur. Puedes ir al Sur con el comando <em>S</em>. Puedes recoger la caña con <em>recoger caña</em>',
  'comandos' => array(
    's' => 'ir_hacia("Jardín");',
    'ver' => '$mensajes[] = in_array("Caña", $_SESSION["inventario"]) ? $texto_estandard["nada"] : "Hey, hay una caña de pescar en el suelo!";',
    'recoger caña' => 'recoger("caña");',
  ),
);

$data['Jardín'] = array(
  'descripción' => 'Estás en el Jardín. Puedes ir al Norte con el comando N. También puedes ejecutar el comando "Ver". También puedes usar el comando "usar caña"',
  'comandos' => array(
    'n' => 'ir_hacia("Casa");',
    'usar caña' => '$mensajes_array[] = "Has usado la caña";',
    'xusar' => 'if (in_array("caña", $_SESSION["inventario"])) { $mensajes_array[] = "Has usado la caña";} else { $mensajes_array = "No tienes caña de pescar";}',
  ),
);

// --------
// PROCESOS
// --------

// Si el Usuario mete un comando ejecutarlo
if (isset($_POST['comando'])){

  echo '<p>debug $_POST: ';
  var_dump($_POST);
  echo '</p>';

  echo '<p>debug $_POST["comando"]: ';
  var_dump($_POST['comando']);
  echo '</p>';


  ejecutar_comando($_POST['comando']);
}

// Si no hay mensajes que mostar, mostrar donde estamos
if (count($mensajes_array) < 1) {
  // $_SESSION['location'] es 'Casa' la primera vez
  // Entonces se le está asignando $data['Casa']['descripción']
  $mensajes_array[] = $data[$_SESSION['location']]['descripción']; 
}

// -----------
// RENDERIZADO
// -----------

// Renderizar mensajes cómo HTML usando implode
$mensajes = '<ul><li>' . implode('</li><li>', $mensajes_array) . '</li></ul>';

// Renderizar inventario
$inventario = '<p> No tienes objetos en tu inventario </p>';
if (isset($_SESSION['inventario']) && count($_SESSION['inventario']) > 0 ) {
  $inventario = '<ul><li>' . implode('</li><li>', $_SESSION['inventario']) . '</li></ul>';
}
$inventario = '<h4>Inventario:</h4>' . $inventario;

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
<form action="11-juego-aventura-cli.php" method="post">
  Tu comando: <input type="text" name="comando" />
  <input type="submit" value="Hazlo" />
</form>

<div>
<?php
print $mensajes;
print $inventario;
?>
</div>

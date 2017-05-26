<?php

var_dump($_POST);

// Número de inputs
$num_inputs = 1;
$input_forms = '';

// Comprobar número de inputs
if (isset($_POST['action']) && $_POST['action'] =='generar_inputs'){
  $num_inputs = $_POST['num'];
}

// Generar input_forms
for ($i = 1;$i <= $num_inputs; $i++){
  // Guardamos valores anteriores
  $palabra   = isset($_POST['palabra_'.$i]) ? $_POST['palabra_'.$i] : '';
  $reemplazo = isset($_POST['reemplazo_'.$i]) ? $_POST['reemplazo_'.$i] : '';

  // Generación de los inputs en formato html
  $input_forms .= '<p> Palabra nr. ' . $i . ' a ser Reemplazada:';
  $input_forms .= '<input type="text" name="palabra_' . $i . '" value="' . $palabra . '" />';
  $input_forms .= ' con uno de ';
  $input_forms .= '<input type="text" name="reemplazo_'.$i.'" size="30" value="'.$reemplazo.'" /></p> ';

}

// Comprobar si existe variable POST
// usando && nos aseguramos que este con un valor
if (isset($_POST['action']) && $_POST['action'] =='generar_frase'){

  // Número de Inputs
  $num_inputs = $_POST['num'];

  // Obtenemos nuestra frase original
  $frase = $_POST['frase'];

  print "<h5>Frase Original:".$frase.'</h5>';

  for ($i = 1; $i <= $num_inputs; $i++){
    
    $array_reemplazos_limpio = array();

    // Obtenemos los reemplazos separados por comas y los metemos en nuestro array
    $array_reemplazos = explode (',', $_POST['reemplazo_'.$i]);

    // Limpiamos el array de reemplazos
    foreach ($array_reemplazos as $valor){
      $array_reemplazos_limpio [] = trim($valor);
    }

    // Obtenemos el token a ser cambiado
    $palabra = $_POST['palabra_'.$i];

    print "<p>Palabra a ser cambiada:".$palabra.'</br>';


    // Generamos la palabra de reemplazo
    $reemplazo = array_rand(array_flip($array_reemplazos_limpio));

    print "Reemplazo elegido:".$reemplazo.'</p>';

    // Sustituimos el String
    $frase = str_replace($palabra, $reemplazo, $frase);
  }

  print "<h3>".$frase."</h3>";
}

?>

<form action="08-form-loop-html.php" method="post">
  <p> Número de input_forms a ser generados 
    <input type="text" name="num" value="<?php print $num_inputs; ?>" />
  </p>
  <p> <input type="submit" value="Generar Inputs" /> </p>
  <input type="hidden" name="action" value="generar_inputs" />
</form>

<form action="08-form-loop-html.php" method="post">
  <p> Mete una frase con palabras a ser reemplazdas. Los reemplazos sepáralos con comas.</p>
  <p> <input type="text" size="100" name="frase" value="<?php print isset($_POST['string']) ? $_POST['string'] : ''; ?>" /> 
  </p>
  <?php print $input_forms; ?>
  <input type="submit" value="Generar Frase"/>
  <input type="hidden" name="action" value="generar_frase"/>
  <input type="hidden" name="num" value="<?php print $num_inputs; ?>"/>
</form>

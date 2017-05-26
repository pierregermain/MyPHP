<?php

var_dump($_POST);

// Comprobar si existe variable POST
// usando && nos aseguramos que este con un valor
if (isset($_POST['action']) && $_POST['action'] =='generar'){


  // Obtenemos nuestra frase original
  $frase = $_POST['frase'];

  for ($i = 1; $i <= 3; $i++){
    
    $array_reemplazos_limpio = array();

    // Obtenemos los reemplazos separados por comas y los metemos en nuestro array
    $array_reemplazos = explode (',', $_POST['reemplazo_'.$i]);

    // Limpiamos el array de reemplazos
    foreach ($array_reemplazos as $valor){
      $array_reemplazos_limpio [] = trim($valor);
    }

    // Obtenemos el token a ser cambiado
    $palabra = $_POST['palabra_'.$i];


    // Generamos la palabra de reemplazo
    $reemplazo = array_rand(array_flip($array_reemplazos_limpio));

    // Sustituimos el String
    $frase = str_replace($palabra, $reemplazo, $frase);
  }

  print "<h3>".$frase."</h3>";
}

?>

<p><b> Form con Valores por defecto:</b></p>

<form action="07-form-check-POST.php" method="post">
  <p> Mete una frase con palabras a ser reemplazdas. Los reemplazos sepáralos con comas.</p>
  <p> <input type="text" size="100" name="frase" value="HOLA PEPITO, ¿ Te gusta NIRVANA ?" /> </p>
  <p> Palabra a ser Reemplazada: 
      <input type="text" name="palabra_1" value="HOLA" /> con uno de <input type="text" name="reemplazo_1" size="30" value="Buenos Días, Hey"/></p>
  <p> Palabra a ser Reemplazada: 
      <input type="text" name="palabra_2" value="PEPITO" /> con uno de <input type="text" name="reemplazo_2" size="30" value="Pierre,Ely,Marc" /></p>
  <p> Palabra a ser Reemplazada: 
      <input type="text" name="palabra_3" value="NIRVANA"/> con uno de <input type="text" name="reemplazo_3" size="30" value="ATCQ,Prince,RHCP" /></p>
  <input type="submit" value="Generar"/>
  <input type="hidden" name="action" value="generar"/>
</form>

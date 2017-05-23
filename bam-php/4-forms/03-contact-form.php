<?php

//
// Para correr esto en D7, tareas a hacer
// 1. Activar PHP filter
// 2. Pegar el código en Página Básica
// 3. Cambiar el action="03..." al nombre del nodo
//

if (isset($_REQUEST['action'])) {

  if ($_REQUEST['action'] == 'contactar') {
    // Debug
    var_dump($_POST);

    // Escribir correo
    $body = '';

    foreach ($_POST as $key => $val) {

      // Si estamos ante el array de atributos
      if (is_array($val)){
        foreach ($val as $key => $val) {
          $body .= 'mandar:' . $val . "\n";
        }
      }

      else {
       if ($key != 'action') { 
        $body .= $key . ':' . $val . "\n";
       }
      }
    }

    $body = "Has recibido una petición. Resultados:\n" . $body;
    print '<hr>';
    var_dump($body);

    // Mandar Mail con PHP
    mail('pierrewb@itesm.com','Petición',$body);
  
  }
}
?>
<hr>
<form action="03-contact-form.php" method="post">
 <table>
  <!--Inputs de tipo texto:-->
  <tr> 
    <td> Nombre* </td> 
    <td><input type="text" name="nombre" required /></td>
  </tr>
  <tr>
    <td> Email* </td> 
    <td><input type="text" name="email"  required/></td>
  </tr>
  <!--Area de Texto:-->
  <tr> 
    <td> Comentario* </td> 
    <td><textarea name="comentario"  required/></textarea></td>
  </tr>
  <tr>
    <td></td>
    <td> Array de checkboxes: </br>
      <input type="checkbox" name="atributos[]" value="mail personal"> Estoy interesado en que me contacten de forma personal</br> </input>
      <input type="checkbox" name="atributos[]" value="newsletter"> Estoy interesado en recibir el Newsletter </input>
    </td>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" value="submit"</input></td>
  </tr>
 </table>
 <!-- Action -->
 <input type="hidden" name="action" value="contactar"/>
</form>






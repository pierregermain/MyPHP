<?php

echo $user_ip = $_SERVER['REMOTE_ADDR'];

function tu_ip(){
  // esto no va a devolver la ip ya que la variable no esta definida localmente en la función
  echo '<br>Ejemplo 1,Tu IP es'.$user_ip;
}

function tu_ip_global(){

  $user_ip = 'super-null';

  // le decimos a la función que acceda a la variable definida antes
  // es lo que se llama definir la variable de manera global
  // significa que van a acceder a la versión global de la variable, no la interna
  // el valor anterior es machacado por el valor global.
  global $user_ip;

  echo '<br>Ejemplo 2,Tu IP es'.$user_ip;
}

tu_ip();
tu_ip_global();

?>

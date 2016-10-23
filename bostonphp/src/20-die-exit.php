<?php
// Ir cambiando este valor para ver los diferentes ejemplos
$num = 5;

// Al insertar die() o exit() las líneas que vienen a continuación del mismo
// no se ejecutan

if ($num == 1){
  echo 'hola 1 ';
  die();
  echo 'mundo<br>';
}

if ($num == 2){
  echo 'hola 2 ';
  exit();
  echo 'mundo<br>';
}

// Al die le podemos poner un mensaje de error
if ($num == 3){
  echo 'hola 3 ';
  die("Ha ocurrido un Error, hemos ejecutado die");
  echo 'mundo<br>';
}

// Al exit también le podemos poner un mensaje de error
if ($num == 4){
  echo 'hola 4 ';
  die("Ha ocurrido un Error, hemos ejecutado exit");
  echo 'mundo<br>';
}

// TODO EJEMPLOS mas realistas
// Ejemplo de mensaje de error por defecto
if ($num == 5){
  mysql_connect('localhost','my-user','my-pwd');
}

// Ejemplo de mensaje de error original + customizado
if ($num == 6){
  mysql_connect('localhost','my-user','my-pwd')
    || die ('Ha ocurrido un error al conectar a la DB');
  echo 'Conectado a la DB';

}

// Ejemplo de mensaje de error customizado
// Agregamos un '@' delante del mysql_connect si no queremos ver el mensaje original
if ($num == 7){

  @mysql_connect('localhost','my-user','my-pwd')
    || die ('Ha ocurrido un error al conectar a la DB');

  echo 'Conectado a la DB';

}

?>

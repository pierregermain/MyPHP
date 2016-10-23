<?php

$num = 10;
$false = 0;

// siempre se ejecuta el do antes del while
do{
  echo "Hello $num<br>";
  $num--;
} while ($num > 0);


// esto se ejecuta una vez ya que 0 es false
do{
  echo "Adios $num<br>";
} while ($false);

?>

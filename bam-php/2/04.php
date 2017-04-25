<?php
//arrays simples

// definición de arrays
$my_array = array('item 1','item 2','item 3');

//Añadir item
$my_array[] = 'item 4';

//Acceder al array. El index empieza en cero
echo $my_array[0];
echo '<br>';

// Desde el source code se ve bien todo esto del array
var_dump($my_array);


/*
	
  item 1<br>array(4) {
  [0]=>
  string(6) "item 1"
  [1]=>
  string(6) "item 2"
  [2]=>
  string(6) "item 3"
  [3]=>
  string(6) "item 4"
}

 */

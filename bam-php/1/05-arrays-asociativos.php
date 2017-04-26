<?php
//arrays asociativos

//definición
$my_array = array('Pierre' => 1978, 'Ely' => 1982, 'Marc' => 1988, 'Kelly' => 1998);

//añadir
$my_array['Hans'] = 2016;

//acceder (ya no se puede usando números cómo en arrays normales)
echo $my_array['Pierre'];
echo '<br>';

//debug array
//desde firefox para verlo guay
//view-source:http://localhost:8088/w/bam-php/2/05.php
var_dump($my_array);

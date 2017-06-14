<?php

$data['descripción'] = 'Estás en el Jardín. Puedes ir al Norte con el comando N. También puedes ejecutar el comando "Ver". También puedes usar el comando "usar caña"';

$data['comandos'] = array(
 'n' => 'ir_hacia("casa");',
 'usar caña' => 'if (in_array("caña", $_SESSION["inventario"])) { journal("Has usado la caña");} else { journal("No tienes caña de pescar");}',
);

<?php

// Array de datos
// los comandos deben estar en minúsculas
$data['descripción'] = 'Estás en la casa. Hay una puerta al Este y una ventana al Sur. Puedes ir al Sur con el comando <em>S</em>. Puedes recoger la caña con <em>recoger caña</em>';

$data['comandos'] = array(
 's' => 'ir_hacia("jardin");',
 'ver' => '$mensajes_array[] = in_array("caña", $_SESSION["inventario"]) ? "No hay nada especial que ver" : "Hey, hay una caña de pescar en el suelo!";',
 'recoger caña' => 'recoger("caña");',
);

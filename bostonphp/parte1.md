Basado en el curso de The New Boston PHP Course

Liga: https://www.youtube.com/playlist?list=PL442FA2C127377F07

# Introducción a PHP

 - Recursive acronym for *PHP: Hypertext Preprocessor*
 - Compilado por parte del servidor: El usuario no puede ver el código
 - www.php.net/manual/en tiene un buen buscador de funciones, etc.
 - Intérprete: *Zend Engine* escrito en C, Software Libre

## i) Docker y PHP

Al contrario de lo normal (es instalar LAMP/MAMP/WAMP), voy a seguir este tutorial usando docker.

[hub.docker.com/_/php/](https://hub.docker.com/_/php/)

Creamos el siguiente sistema de directorios/ficheros

```
[bostonphp] 
├── Dockerfile
└── src
    └── index.php
```

```
#Dockerfile
FROM php:5.6-apache
COPY src /var/www/html/
```

```
#index.php 
<?php
echo '<strong>hola mundo</strong>';
?>
```

Desde la misma carpeta ejecutamos
```
docker build -t boston-php-app .
docker run -it --rm --name bostonphp boston-php-app
```

 
 La opción *-it* significa que es interactivo (creo que no hace falta), pero la opción *-rm* significa que al final se va a destruir la instancia  del contenedor, y esa opción si es muy recomendle usarla para que podam os volver a levantar instancias de forma fácil sin destruir la instancia  anterior.


Con nuestro navegador nos vamos a la IP del contenedor, y voila, debe salir el mensaje **Hola Mundo**

Ahora que ya esta funcionando podemos usar el siguiente comando *run* para que al realizar cambios en nuestro local se vea también en nuestro contenedor

```
 docker run -it --rm -v ~/webapps/bostonphp/src:/var/www/html/:rw --name bostonphp boston-php-app
 ```

## ii) Creando tu primer fichero PHP

 - Dependiendo de cómo instalas apache tu directorio donde guardas los ficheros php estará en una ruta o en otra. En nuestro caso el directorio webapps es */var/www/html*. A partir de ahora voy a llamar a esa ruta nuestro webapps.
 - Muchas veces a dicho directorio también se le da el nombre de *htdocs*. En nuestro caso hemos configurado docker para que use el directorio */var/www/html*.
 - Vamos a crear un fichero nuevo llamada *mi-primer-fichero.php* en nuestro directorio de webapps. Recordemos que dicho fichero estará en *bostonphp/src* que se corresponde con */var/www/html* en nuestro docker
 - Dicho fichero por ahora estará vacío.
 - Si nos vamos a http://172.17.0.2/mi-primer-fichero.php no muestra nada.

 - Hola Mundo:

```
<?php
echo " Hola Mundo
?>
```

### Sintaxis Creación del primer fichero

Recomendable:

```
<?php?>
```
Posible:

```
<?

?>
```

Por defecto Apache carga automáticamente los `index.php`

# 00 Función phpinfo

Usando este fichero podemos ver toda la información relacionada con nuestra instancia de PHP.

```
<?php
  phpinfo();
?>
```

[Liga](MyPHP/bostonphp/src/00-phpinfo.php)


Recuerda no tener este fichero en producción

## El Fichero php.ini

 - Primero hay que saber cómo encontrar dicho fichero. En dicho fichero viene toda la configuración de nuestra instancia de PHP.
    - Desde la terminal y con la función phpinfo().
 - Muchas veces hay errores que se pueden quitar modificando dicho fichero.
 - Hay que reiniciar Apache para que se tomen los nuevos valores introducidos.

## Identación
 - En Drupal usamos dos espacios.
 - Configurar bien tu editor para que los haga automáticamente.

# 01 Echo

 - Salida al Navegador
 - Usamos " para poder meter variables dentro del Echo.
 - Usamos ' para no usar variables dentro del echo sino concatenando con el punto (.).
 - No deberíamos usar html dentro del echo, se puede hacer, pero hay mejores maneras.

```
<?php
echo '<strong>hola mundo</strong>';
?>
```

# 02 Print
 - Manera tradicional
 - Más lento que Echo
 - Deberíamos usar Echo en vez de Echo
 - Print debe usar parentesis al funcionar cómo una función.


```
<?php
print ('<strong>hola mundo</strong>');
?>
```

# 03 HTML con PHP

 - Usar comillas simples para el echo, y usar comillas sobles

```
// Usar comillas simples es más rápido para el intérprete
echo '<input type="text" name="name">';
```

# 04 Integrar PHP en HTML

 - Ejemplo de meter una variable PHP en HTML.
 - Hacemos todo desde una línea para que sea más limpio el código.

```
<?php
$text = 'Hola Mundo';
?>

<input type="text" value="<?php echo $text; ?>">
```

# 05 Comentarios

```
<?php

/* Comentario de
varias líneas /*

// Comentario de una línea
$text = 'Hola Mundo';
echo $text;

?>
```

# 06 Reportar Errores

 - Para ver si esta activado irse al fichero `php.ini` y buscar `error_reporting`
 - Los tipos de errores empiezan con `E_`, por ejemplo `E_ALL`
 - Muchas veces tendremos `error_reporting = 0`, en tal caso no se mostrarán los errores.

 - Para activar errores poner `error_reporting = E_ALL`

 - Ejemplo: No usar un punto y coma

```
<?php

// Línea a la que le falta un punto y coma
$text = 'Hola Mundo'
echo $text;

?>

```

 - Dicho Fichero al ejecutarlo si no tenemos error_reporting activado nos mandará un WSOD (White Screen of Death)
 - Dicho Fichero al ejecutarlo si tenemos error_reporting activado nos devolverá:

  *Parse error: syntax error, unexpected 'echo' (T_ECHO) in /var/www/html/06-errores.php on line 5*

## TODO Error Reporting (Segunda parte)

Meter en el php.ini:

 - Para todos los errores y coding standards:
   `error_reporting = E_ALL & E_STRICT`

 - Para mostrar todos los errores pero no los Warnings pero si los coding standards:
  `error_reporting = E_ALL & ~E_NOTICE |E_STRICT`

 - Para mostrar todos los errores pero no los Warnings ni los coding standards:
   `error_reporting = E_ALL & ~E_NOTICE `

 - En Producción deberíamos tener todo esto desactivado

### TODO Elegir Error Reporting desde el fichero a ser ejecutado

A mi esto NO me ha funcionado.

En el propio fichero a ser debuggeado podemos meter los siguiente antes de nuestro código a ser debuggeado:

```
// No mostrar Errores, dos formas de hacerlo
error_reporting(0);
ini_set('error_reporting', 0);

// Mostrar TODOS los errores posibles
error_reporting(-1);
ini_set('error_reporting', -1);
```

# 07 Variables

```
<?php

// imprimir y asignar a la vez
echo $text = 'Hola Mundo';
echo $number = 100;
echo $decimal = 100.2;
echo $boolean = true;
echo $boolean = false;

//solo imprimir
echo $text;

?>
```

#08 Concatenación

```
<?php

// imprimir y asignar a la vez
$text = 'Hola Mundo';
$fecha = '20/8/78';

//imprimir con concatenación
echo $text.', Yo he nacido el '.$fecha.'<br>';

//imprimir sin concatenación
echo "$text, Yo he nacido el $fecha";

?>
```

#09 if else

```
<?php

// Ejemplo 1

if (1){
  echo 'TRUE';//esto se imprime
}


// Ejemplo 2

if (0){
  echo 'TRUE';//esto no se imprime
}
 else {
  echo 'FALSE';//esto se imprime
}


// Ejemplo 3

if (1==2){
  echo '1 es 2';//esto no se imprime
}
 else {
  echo '1 no es 2';//esto se imprime
}

// Ejemplo 4

$text = 'Algo';

if ($text=='Algo'){
  echo '$text es Algo';//esto se imprime
}

?>

```

# 10 if / else if

```
<?php

// Ejemplo 1

$number = 10;

if ($number == 11){
  echo 'es 11<br>';//esto no se imprime
} else if ($number == 10){
  echo 'es 10<br>';//esto se imprime
}

// Ejemplo 2

$number = 10;

if ($number == 11){
  echo 'es 11<br>';//esto no se imprime
} else if ($number == 12){
  echo 'es 12<br>';//esto no se imprime
} else {
  echo 'No es igual a 11 ni 12';//esto se imprime
}
?>
```

# 11 Asignaciones

```
<?php

// Ejemplo 1: Suma

$num1 = 10;
$num2 = 12;

$result = $num1 + $num2;

echo $result.'<br>';//Imprime 22

$num1 += 5;

echo $num1.'<br>';//Imprime 15

// Ejemplo 2:Concatenación

$text = 'Hola';
$text .= ' Mundo';

echo $text.'<br>';// Imprime Hola Mundo

// Ejemplo 3:Resta

$num = 10;
$num -= 2;

echo $num.'<br>';// Imprime 8

// Ejemplo 3: División

$num = 10;
$num /= 2;

echo $num.'<br>';// Imprime 5

// Ejemplo 3: Módulo

$num = 11;
$num %= 3;

echo $num.'<br>';// Imprime 2

```

# 12 Operadores de comparación

```

<?php

// Para probar ir cambiando estos valores
$num1 = 13;
$num2 = 12;

$result = $num1 + $num2;

// Igualdad
if ($num1 == $num2){
  echo 'igual';
}

// Desigualdad
if ($num1 != $num2){
  echo ',desigual bonito';
}

if ($num1 <> $num2){
  echo ',desigual feo';
}

// Mayor o igual que
if ($num1 >= $num2){
  echo ',mayor o igual que';
}
// Mayor que
if ($num1 > $num2){
  echo ',mayor que';
}

```

#13 Operadores Aritméticos

```
<?php

// suma
$sum = 10 + 10;

// resta
$sum = $sum - 2;

// división
$sum = $sum/9;

// multiplicación
$sum = $sum * 3;

// módulo
$sum = $sum % 4; //6 % 4 = 2

echo $sum;// 2

// -----------------------
// Operadores Especiales
// -----------------------

// incremento

$sum++;

// decremento

$sum--;

echo $sum;//2

// -----------------------
// Orden de los operadores
// -----------------------

$sum = $sum + 6 / 2;

echo $sum;// 5 = 2 + 3

$sum = (6 + 2) / 2;

echo $sum;// 4
```

#14 Operadores Lógicos

```

<?php

$max = 1000;
$min = 500;

// Hacer pruebas con este valor
$num = 599;

// AND
// a la antigua
if ($num > $min AND $num < $max){
  echo 'O';
}

// a la nueva
if ($num > $min && $num < $max){
  echo 'K';
}

// OR
// a la antigua
if ($num == $min OR $num == $max){
  echo 'oh';
}

// a la nueva
if ($num == $min || $num == $max){
  echo 'key';
}

// NOT
if (!($num == 599)){
  echo ',it is not 599';
}
else {
  echo ',it is 599';
}

?>

```

#15 Igualdades Triples

```
<?php

$num1 = '1';//esto es un string
$num2 = 1;  //esto es un int

// Comparación de valores
// usando casting automático
if ($num1 == $num2){
  echo "'$num1' y $num2 SI son iguales usando ==<br>";// este se ejecuta
}
else{
  echo "'$num1' y $num2 no son iguales usando ==";
}

// Comparación de valores
// no usando casting automático
if ($num1 === $num2){
  echo "'$num1' y $num2 son iguales usando ===";
}
else{
  echo "'$num1' y $num2 NO son iguales usando ===";// este se ejecuta
}
?>
```

#16 bucle while

```
<?php

$num = 10;

while ($num > 0){
  $num--;
  echo "Hello $num<br>";
}

  echo 'Adios<br>';
?>
```

# 17 bucle do while

```
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
```

# 18 bucle for

```
<?php

// for $num = 9, while $num is >=0 do $num--
for ($num = 9; $num >= 0; $num--) {
  echo $num.'<br>';
}

?>
```

# 19 switch

```
<?php

$num = 3;

// Ejemplo 1 sin default
switch ($num) {

  case 2:
    echo 'dos';
  break;

  case 3:
    echo 'tres<br>';
  break;

  case 4:
    echo 'cuatro';
  break;
}

// Ejemplo 2 con default
switch ($num) {
  case 1:
    echo 'uno';
  break;

  case 2:
    echo 'dos';
  break;

  default:
    echo 'no encontrado<br>';
  break;
}

// Ejemplo 3 sin break
switch ($num) {
  case 2:
  case 3:
    echo 'es dos o tres';
  break;

  default:
    echo 'no encontrado';
  break;
}
?>

```

#20 funciones die y exit (T29)

``` 

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

```


### TODO EJEMPLOS mas realistas

```
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
```




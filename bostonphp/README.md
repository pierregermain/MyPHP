Basado en el curso de (The New Boston PHP Course)[https://www.youtube.com/playlist?list=PL442FA2C127377F07]

# Introducción a PHP

 - Recursive acronym for *PHP: Hypertext Preprocessor*
 - Compilado por parte del servidor: El usuario no puede ver el código
 - www.php.net/manual/en tiene un buen buscador de funciones, etc.
 - Intérprete: *Zend Engine* escrito en C, Software Libre

## i) Docker y PHP

Al contrario de lo normal (es instalar LAMP/MAMP/WAMP), voy a seguir este tutorial usando docker. Deberemos tener ya docker instalado (si no es el caso, mira wiki en MyDocker)

Vamos a usar este docker file:

[hub.docker.com/_/php/](https://hub.docker.com/_/php/)

Creamos el siguiente sistema de directorios/ficheros (podemos bajarnos todo usando git clone de este proyecto)

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
 
 ó
 
 docker run -it --rm -v ~/webapps/MyPHP/bostonphp/src:/var/www/html/:rw --name bostonphp boston-php-app
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

[Liga](src/index.php)

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

[Liga](src/00-phpinfo.php)

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

[Liga](src/01-echo.php)

# 02 Print
 - Manera tradicional
 - Más lento que Echo
 - Deberíamos usar Echo en vez de Echo
 - Print debe usar parentesis al funcionar cómo una función.

[Liga](src/02-print.php)

# 03 HTML con PHP

 - Usar comillas simples para el echo, y usar comillas sobles.

[Liga](src/03-html.php)

# 04 Integrar PHP en HTML

 - Ejemplo de meter una variable PHP en HTML.
 - Hacemos todo desde una sóla línea para que sea más limpio el código.

[Liga](src/04-embeb-html.php)

# 05 Comentarios

[Liga](src/05-comentarios.php)

# 06 Reportar Errores

 - Para ver si esta activado irse al fichero `php.ini` y buscar `error_reporting`
 - Los tipos de errores empiezan con `E_`, por ejemplo `E_ALL`
 - Muchas veces tendremos `error_reporting = 0`, en tal caso no se mostrarán los errores.

 - Para activar errores poner `error_reporting = E_ALL`

 - Ejemplo: No usar un punto y coma

[Liga](src/06-errores.php)

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

[Liga Ejemplo](src/07-variables.php)


#08 Concatenación

[Liga Ejemplo](src/08-concatenation.php)


#09 if else

[Liga Ejemplo](src/09-ifelse.php)


# 10 if / else if

[Liga Ejemplo](src/10-if-elseif.php)


# 11 Asignaciones

[Liga Ejemplo](src/11-asignaciones.php)


# 12 Operadores de comparación

[Liga Ejemplo](src/12-comparacion.php)

# 13 Operadores Aritméticos

[Liga Ejemplo](src/13-aritmetica.php)

# 14 Operadores Lógicos

[Liga Ejemplo](src/14-logicos.php)

# 15 Igualdades Triples

[Liga Ejemplo](src/15-igualdades-triples.php)

# 16 Bucle while

[Liga Ejemplo](src/16-loop.php)

# 17 Bucle do while

[Liga Ejemplo ](src/17-do-while.php)

# 18 Bucle for

[Liga Ejemplo](src/18-for.php)

# 19 Sentencia switch

[Liga Ejemplo](src/19-switch.php)


# 20 funciones die y exit (T29)

[Liga](src/20-die-exit.php)

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

---
Parte 2
---

# 21 Funciones

Ejemplo de Hola Mundo usando una función

[Liga](src/21-funciones.php)

# 22 Funciones con Argumentos

[Liga](src/22-funciones-argumentos.php)

# 23 Funciones con retorno

[Liga](src/23-funciones-return.php)

# 24 Variables Globales y Funciones

[Liga](src/24-globales-funciones.php)

# 25 Funciones Strings

## 25-1 Contar Palabras

[Liga](src/25-1-funciones-string.php)

## 25-2 Generador de contraseñas

[Liga](src/25-2-funciones-string.php)

## 25-3 Ver similitud de Strings

[Liga](src/25-3-funciones-string.php)

## 25-4 trim

[Liga](src/25-4-funciones-string.php)

## 25-5 Más Funciones de String

### rtrim y ltrim

Vimos antes que *trim* nos sirve para recortar un string por los lados derechos e izquierdos. Si sólo queremos recortar un string por uno de los lados vamos a usar *rtrim* y *ltrim*

Ejemplo

[Liga](src/25-5-funciones-string.php)

## 25-6 Más Funciones de String

### addslashes y stripslashes

[Liga](src/25-6-funciones-string.php)

--- 
Parte 3
----

# 26 Arreglos

En Drupal usamos un montón los arreglos (Arrays) ... más te vale entenderlos bien.

## 26 - 1 Introducción

 - Inicializar
 - Acceder
 - Debuggear
 - Asignar
 
[Liga](src/26-1-arrays.php)


## 26 - 2 Arrays Asociativos

En los arrays anteriores vimos que los índices son número naturales del 0 al infinito.

En los arreglos asociativos podemos denominar los índices con la información que nosotros queramos.
En nuestro ejemplo cada índice va a ser una comida y el contenido será un día de la semana

[Liga](src/26-2-arrays.php)


## 26 - 3 Arrays Multidimensionales

Son arrays dentro de arrays. Vamos a seguir con nuestro ejemplo de comidas. Vamos a dividir la comida en saludable e insaludable

[Liga](src/26-3-arrays.php)


## 26 - 4 Recorrer un Arreglo con for each

Vamos a ver cómo recorrar nuestro array multidemensional con dos bucles for each.

[Liga](src/26-4-arrays.php)

# 27 Include 

 - Con el include podemos meter en nuestra página otras páginas.

[Liga](src/27-include.php) que usa [Liga](src/27-aux.php)

# 28 Requiere (T42)

 - Sirve para asegurarse de que cierto fichero exista.
 - Al contrario del include, el requiere se para de ejecutar si no encuentra el fichero.

[Liga](src/28-require.php) que usa [Liga](src/28-aux.php)


# 29 Include once (T43)

Por Hacer


# 30 Require once

Por Hacer















 















# Resumen/Notas PHP

## Hack para ver Errores sin modificar php.ini

```
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
```

Desde el php.ini sería:

```
display_startup_errors = On
display_errors = On
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
```

## Mysqli Snippet

#### Conexión

```
  $mysqli = mysqli_connect('server', 'user', 'pass', 'db');

  if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
  }
```

#### Query

```
$mysqli = db_connect();
$query = "";
$mysqli->real_query($query);
$result = $mysqli->use_result();
while ($row = $result->fetch_assoc()) {
  $row;
}

// Para Errores
mysqli_error($mysqli);

```

## Variables
```
$var = 'string';
$var = array ('uno','dos');
$var = new stdClass; // Objeto
$var = FALSE;
$var = 42;
```

### Asignaciones y Operadores

```
$a  = $b;
$a += $b;
$a -= $b;      // $a = $a - $b
$a .= $b;      // concatenación
$a  = $a . $b; // concatenar
$a  = &$b;     // $a apunta a $b
```

## Estructuras de Control
```
if ($var > 42) {}
elseif ($var < 42) {}
```
## Loop
```
foreach ($array as $llave => $valor) {}
while ($i < 42) {}
for ($i=0; $i<42; $i++){}
```
## Comparadores
```
Ej) if ($a == $b) {}

==  // igualdad (valor)
=== // identico (valor y tipo igual)
!=  // no igualdad
<>  // no igualdad
!== // no identico (valor ó tipo)
<
>
<=               
>=     
```

## Suma / Resta
```
$a--;
$a++;
```

## Operadores Aritméticos
```
$a = -$b;
$a + $b;
$a - $b;
$a * $b;
$a / $b;
$a % $b;
```

## Operadores Lógicos
```
Ej.) if ($a AND $b){}
&&
OR
||
XOR // devuelve TRUE si $a o $b es true pero no ambos
```
### Negación
```
if (!$a){}
```
## Operadores de Arrays
```
$c = $a + $b;      // Unión (quita duplicados)
if ($a == $b)  {}  // TRUE si    misma pareja llave / valor 
if ($a === $b) {}  // TRUE si    misma pareja llave / valor en el mismo orden
if ($a != $b)  {}  // TRUE si no misma pareja llave / valor
if ($a <> $b)  {}  // TRUE si no misma pareja llave / valor
if ($a !== $b) {}  // TRUE si no misma pareja llave / valor en el mismo orden 
```

## Funciones Nativas
```
strlen();
date();
array_rand();
explode();
trim();
```

## Funciones custom
```
function f1($var) {}
function f2(&$var) {}
```

## Errores Comunes

1. Comparar (==) vs Igualar (=)

2. Falta de cierre de llaves *}*:
Pongle varios paréntesis de cierre para que el compilador te diga donde falta uno.
(unexpected "}" ).

3. Falta de apertura de llaves *{*:
Nos da el mismo error que en 2 (unexpected "}" ).

4. Falta de paréntesis:
Nos da el error tipo 3 (unexpected "{" ).

5. Falta de argumento:
Wrong parameter count.


## Diff/Merge

OSX : FileMerge

# 5 - DB

## Ejercicios DB

Al terminar 5-db tareas para mejorar mi capacidad para trabajar con PHP y DB serían:
 - mejorar el juego de aventuras
   - guardar posición e inventario en la db
   - conectarse al juego con user/pass
   - poder buscar otros jugadores por varios campos o todos los campos
 - mejorar el generador de frases
   - guardar los tokens
   - poder guardar tokens por usuario
   - poder compartir frases generadas con otros usuarios

# 6 - CMS

En este tema vamos a hacer nuestro propio CMS. Eso nos va a mostar PORQUE es bueno usar DRUPAL y no tener nuestro propio CMS. Esto nos va a permitir entender mejor DRUPAL

## Site Estático

Empezamos con un site estático:
`/01-site`

Con estos ficheros

```
├── about.html
├── contact.html
├── images
│   ├── founder.jpg
│   ├── logo.png
│   ├── product-1.jpg
│   ├── product-2.jpg
│   ├── product-3.jpg
│   ├── product-4.jpg
│   ├── product-5.jpg
│   ├── product-6.jpg
│   ├── sticks.jpg
│   └── use-card.png
├── index.html
├── products.html
└── styles
    └── style.css
    
```
    
#### Site Estático con Includes 

Ver `02-site-header-footer`

Ahora nuestros *.html los cambiamos a *.php para que inluyan los ficheros `footer.php` 
y `header.php`

#### Site Estático con Funciones para imprimir productos

Ver `03-site-products-function`

Agregamos la función

```
foreach ($products as $product) {
    $product_output .= render_product($product);
}
```

#### Site Estático con Data File

Ver `04-products-data-file`

Antes de empezar a guardar los datos en DB, vamos a guardarlo por ahora en un fichero php.
Vamos a usar **Unique Identifier** para cada producto (también podríamos usar UUID's)

Agregamos el fichero `data/product-data.php` y lo usamos desde `header.php`. 
Ahora la función de renderizado toma los Id's de los productos.
También lo usamos desde `products.php` sin pasarle ningún argumento.

## Site con htaccess

Ver `01-site-with-htaccess`

Nuestras páginas aún tienen mucho contenido repetido. Para mejorarlo podemos hacer lo siguiente:
 
#### Activar el `mod_rewrite` de apache:

- Ejecutar `a2enmod rewrite`
- Modificar `/etc/apache2/sites-available/default` agregando dentro de `<Virtualhost>`

```
  <Directory /var/www/>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    Order allow,deny
    allow from all
  </Directory>

```
- Agregar `.htaccess`

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?path=$1 [L,QSA]
```

Explicación del .htaccess:

 - Todo lo que está en un .htaccess se aplica recursivamente a la carpeta actual y las subcarpetas
 - *RewriteEngine on* para reescribir URL's desde apache
 - *RewriteCond* son especie de IF's. 
    En este caso para ver si no existe ni fichero ni directorio de la petición. 
    Esto lo hacemos así para que por ejemplo podamos acceder a imágenes con la URL completa.
 - `%{REQUEST_FILENAME}` es la variable de petición. En .htaccess las variables empiezan por `%`
 - *RewriteRule* se ejecuta si se cumplen los *RewriteCond* previos.
 - `(.*)` es todo lo que hay a partir del slash del dominio. Por ejemplo para `localhost.com/site/` sería `site`
 - `$` representa el fin de la URL
 - `index.php` representa el Rewrite: Toda URL que cumpla los RewriteCond van a redireccionarse al index.php
 - `?path=` es la variable que le vamos a pasar al index.php
 - `$1` representa el primer match de `(.*)` y va ser el valor que tome la variable `path`
 - `L` es una bandera para decir que es el último (Last) RewriteRule
 - `QSA` es para mezclar Queries de la URL con la definida en el .htaccess


- Reiniciar: `sudo service apache2 restart`

Más Info en: https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite

#### Caractéristicas de esta página:

- usa una página (tipo template) para todas las páginas.

- Ya sólo tenemos un fichero index.php en nuestro `/site` y en el `.htaccess` configuramos cómo comunicarnos con el apache.

Consideraciones:
 - Ahora el php tag no se cierra en el home
 - Uso de <<<EOD: Para no tener que usar comillas para definir una variable que tiene comillas
 - Uso de template que toma las variables de contenido obtenidas desde el index


## Site con Settings

Ver `02-site-with-settings`

Vamos a agregar Settings para poder cambiar el título del página

La novedad es que en el `index.php` al renderizar productos le pasamos los ID's de los productos favoritos.
```
render_products(get_setting('featured_product_ids'));
```

En el `settings.php` usamos `static $settings;` para sólo cargar una vez las configuraciones.
Es bueno meter todas nuestras variables globales en el settings.php para que no otras personas
usen el mismo nombre que nuestra variable.
Para asegurarnos que usamos la variable correcta usamos el *get_settings* function. Dicha función
sólo lee las configuraciones del settings.php

Ahora para imprimir el título de la página en el template usamos `<?php print $company_name; ?>`

## Site con Base de Datos

#### Preparación

Nuestros datos siguen estando en array tipo php y eso no es bueno para el mantenimiento de nuestra web.
Estaría bien tener un sistema CRUD (Create, Review, Update, Delete) para nuestros Datos.

Vamos a crear una nueva DB con varias tablas:

```mysql
create database amazing_inc;

CREATE TABLE `amazing_inc`.`users` 
( `uid` INT NOT NULL AUTO_INCREMENT , 
`username` VARCHAR(100) NOT NULL , 
`password` VARCHAR(32) NOT NULL , 
PRIMARY KEY (`uid`)) 
ENGINE = InnoDB;

COMMIT;
```

Insertamos un Usuario de prueba

```mysql
INSERT INTO `users` (`uid`, `username`, `password`) VALUES (NULL, 'chris', 'test')
```

#### Estructura del Sitio

Ver `03-site-with-db-and-login`

 - La configuración a la DB está en el settings.php
 - En el index:
   - Usamos session_start(); para trackear el usuario
   - Realizamos conexión a DB con db_connect() usando mysqli_connect
   - Usamos get_notices(); para mostrar el array de $notices al usuario
   
## Site con User Admin

Ver `04-site-with-user-administration`

- Ahora en el `login.php` añadimos tareas que pueden llevar a cabo usuarios autentificados.

## Site con Subfolders

Ver `05-site-with-subfolders`

- Añadimos un directorio para /admin
- Ahora hay links Hay que actualizar ahora los links relativos a absolutos
- Usamos función `url()` definida en nuestro fichero `functions.php` que prepone el `basepath` definido en nuestro `settings`.

## Site con Data Layer en DB para Productos

Ver `06-site-with-products-db`

Creamos una nueva tabla para productos

```mysql
CREATE TABLE 
`amazing_inc`.`products` 
( `pid` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(128) NOT NULL , 
`price` FLOAT(4,2) NOT NULL , 
`image` VARCHAR(256) NOT NULL , 
PRIMARY KEY (`pid`)) 
ENGINE = InnoDB;
```

Insertamos un producto de prueba en nuestra DB

```mysql
INSERT INTO `products` (`pid`, `title`, `price`, `image`) 
VALUES (NULL, 'Mahou', '0.75', 'product-1.jpg')
```

Dejamos el `products.php` dentro de /admin y realizamos modificaciones en:
 - `login.php`: Añadimos opción de modificar productos.
 - `/admin/products.php`: Añadimos la lógica para obtener los datos de la DB. Muy parecido a `/admin/users.php`
 - Añadimos obtener productos desde `includes/functions.php`
 
## Site con funcionalidad CRUD para usuarios y productos

Ver `07-site-with-crud`
 
Añadimos:
 - /includes/crud.php
Modificamos para que usen crud.php:
 - /admin/products.php
 - /admin/users.php
 Dichos ficheros ahora pasan un array a crud.php para obtener los datos.
 
**Ejercicio / Tarea**

Hacer tu mismo un crud.php basado en products.php para aprender a hacer este tipo de programas!!!

## Site con funcionalidad para editar páginas

Ver `08-site-with-crud-pages`

Creamos una nueva tabla para las páginas

```sql
CREATE TABLE `amazing_inc`.`pages` 
( `page_id` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(256) NOT NULL , 
`content` LONGTEXT NOT NULL , 
`path` VARCHAR(256) NOT NULL , 
PRIMARY KEY (`page_id`)) ENGINE = InnoDB;
```

Hacemos lo siguiente:

 - creamos admin/pages.php
 - añadir link de editar paginas en login.php
 - añadir lógica en el index.php

# Que deberíamos añadir

 - sistema de permisos
 - tipos de fields
 - sistema de settings
 - sistema de vistas
 - user link debe mostar logout al hacer login
 - contact form debería ser real
 - sistema de menus
 
# PHP OOP

Ver `09-site-with-a-class`

- modificamos crud.php
- modificamos paginas para usar crud.php

Teoria:
 - Clases tienen Propiedades (vars's) y métodos (function's)
 - Usamos `$this->nombre_variable` para acceder a Propiedades.
 - Usamos `$his->metodo()` para acceder a métodos.





 
 
 

 


 


# Resumen/Notas PHP

## Variables
$var = 'string';
$var = array ('uno','dos');
$var = new stdClass; // Objeto
$var = FALSE;
$var = 42;

### Asignaciones y Operadores

$a  = $b;
$a += $b;
$a -= $b;      // $a = $a - $b
$a .= $b;      // concatenación
$a  = $a . $b; // concatenar
$a  = &$b;     // $a apunta a $b

## Estructuras de Control
if ($var > 42) {}
elseif ($var < 42) {}

## Loop
foreach ($array as $llave => $valor) {}
while ($i < 42) {}
for ($i=0; $i<42; $i++){}

## Comparadores
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

## Suma / Resta
$a--;
$a++;

## Operadores Aritméticos
$a = -$b;
$a + $b;
$a - $b;
$a * $b;
$a / $b;
$a % $b;

## Operadores Lógicos
Ej.) if ($a AND $b){}
&&
OR
||
XOR // devuelve TRUE si $a o $b es true pero no ambos

### Negación
if (!$a){}

## Operadores de Arrays
$c = $a + $b;      // Unión (quita duplicados)
if ($a == $b)  {}  // TRUE si    misma pareja llave / valor 
if ($a === $b) {}  // TRUE si    misma pareja llave / valor en el mismo orden
if ($a != $b)  {}  // TRUE si no misma pareja llave / valor
if ($a <> $b)  {}  // TRUE si no misma pareja llave / valor
if ($a !== $b) {}  // TRUE si no misma pareja llave / valor en el mismo orden 

## Funciones Nativas
strlen();
date();
array_rand();
explode();
trim();

## Funciones custom
function f1($var) {}
function f2(&$var) {}

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
    
## Site Estático con Includes 

Ver `02-site-header-footer`

Ahora nuestros *.html los cambiamos a *.php para que inluyan los ficheros `footer.php` 
y `header.php`










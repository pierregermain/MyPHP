# Mysql

## Login pass por defecto:
root/root

## URL phpmyadmin
localhost:8088/w/phpMyAdmin-4.7.0-all-languages/

Ver en phpmyadmin estructura drupal:
 - Tipos de datos en mysql: tabla user
   - TEXT: Texto ilimitado ( realmente limitado a 65535 chars). Mas lento.
   - VARCHAR: Limitado a 256 chars (configurable). Mas rápido. Puede ser índice. 
 - tablas menu:
   - *menu_tree* y/o *menu_path* no da las clases que ejecutan dicho menu

Pestaña SQL no da el SQL ejecutado.

Mostar 'single quotes' vs `backtick`

```
SELECT * FROM `menu_tree` WHERE menu_name like 'admin%' 
```

## Creación de Tablas

 - Creamos db bam
 - Creamos tabla personas con 3 campos (desde la UI):

```
CREATE TABLE `personas` (
  `nombre` varchar(256) NOT NULL,
  `anyo` int(4) NOT NULL,
  `banda` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;
```

## Inserción de Datos

Insertamos los datos que teníamos en fichero.txt ... Haciendo preview es más fácil

```
INSERT INTO `personas` (`nombre`, `anyo`, `banda`) VALUES ('Pierre','1978','ATCQ');
INSERT INTO `personas` (`nombre`, `anyo`, `banda`) VALUES ('Ely','1982','Nirvana');
INSERT INTO `personas` (`nombre`, `anyo`, `banda`) VALUES ('Marc','1988','Prince');
```

Para poder editar desde el propio grid necesitamos un "unique column"

## Hacer Selects

```
SELECT nombre,anyo FROM `personas` WHERE anyo > 1980 
```

Mostrar el botón *Show query box* para no perder los datos devueltos. Además darle a *Retain query box* para que no se cierre la consola SQL.

## Cliente

Vemos ejemplos 2 a 5 de cómo crear un cliente

Además para los ejemplos posteriores añadimos a `personas` clumnas de nombre de usuario y contraseña

```
ALTER TABLE `personas` 
ADD `username` VARCHAR(100) NOT NULL AFTER `banda`, 
ADD `password` VARCHAR(100) NOT NULL AFTER `username`;
```

Metemos el u/p de nuestros usuarios.

    USERNAME   PASSWORD
 		ely 	    1234
		marc 	    qwerty
		pierre 	  !@#$


### SQL INJECTION

magic_quotes_gpc = Off

Usar en los parámetros de entrada mysqli_real_escape_string
mysqli_real_escape_string($mysqli,$_POST['username']).  "' " .

### SEGURIDAD

Cuanto mas popular sea tu sitio más seguro debe ser.

### Hacer export desde phpmyadmin

La db es pequeña ... okey!

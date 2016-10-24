#!/bin/sh
docker run -it --rm -v ~/webapps/bostonphp/src:/var/www/html/:rw --name bostonphp boston-php-app


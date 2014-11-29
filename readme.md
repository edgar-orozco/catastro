## Catastro

Sistema de gestión catastral

## Instalación
    
    $ git clone https://github.com/edgar-orozco/catastro.git /var/www/html
    $ cd /var/www/html
    $ composer install

## Procedimiento para realizar deploy al servidor de desarrollo:
    $ git push origin staging
Todo push a la rama "staging" será automáticamente reflejado en el servidor de desarrollo central
[Tutorial para manejo de ramas](https://www.atlassian.com/git/tutorials/using-branches)

## Paquetes extra
* Autenticación de usuarios      "zizaco/confide": "~4.0@dev" [Documentación](https://github.com/Zizaco/confide)
* Control de roles y permisos    "zizaco/entrust": "1.2.*@dev" [Documentación](https://github.com/Zizaco/entrust)
* Extensión de Eloquent          "laravelbook/ardent": "~2.4" [Documentación](https://github.com/laravelbook/ardent)        
* Generadores de desarrollo      "way/generators": "~2.0"  [Documentación](https://github.com/JeffreyWay/Laravel-4-Generators)
* Generadores de datos de prueba "fzaninotto/faker": "1.3.*@dev" [Documentación](https://github.com/fzaninotto/Faker)

## CSS Framework
* Bootstrap 3  [Documentación](http://getbootstrap.com/)

## JS Frameworks
* jQuery   [Documentación](http://jquery.com/) 
* AngularJS  [Documentación](https://angularjs.org/)

## Librerías y servidores geográficos.
* PostGIS [Documentación](http://postgis.net/)
* MapServer [Documentación](http://mapserver.org/)

### Licencia

This system is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


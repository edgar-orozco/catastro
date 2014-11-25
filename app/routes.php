<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
|  TODO: Introducir alguna forma de partir las rutas en varios archivos y directorios para tratar de evitar conflictos recurrentes al desarrollar varios equipos el mismo proyecto
*/

Route::get('/', function()
{
	return View::make('hello');
});

/**
 * @author: Edgar Orozco
 * Helper para poder separar en varios archivos las rutas y tener mayor libertad de implementación de rutas por módulo.
 *
 * IMPORTANTE:
 * Las rutas ahora se declaran en el directorio app/routes/NombreModuloRoutes.php
 * Donde NombreModulo es el nombre distintivo del módulo o funcionalidad que se trate.
 *
 * Esto se hace debido a que al modificarse app/routes.php es el archivo que más concurrencia de usuarios tiene, por lo que se crean muchos confilctos de "merge" con git
 * De cualquier forma es la manera en la que Laravel nativamente tiene de cargar el archivo de rutas.
 * @see http://laravel.com/docs/4.2/packages#package-routing
 */
foreach (new DirectoryIterator(__DIR__.'/routes') as $file)
{
    if (!$file->isDot() && !$file->isDir() && $file->getFilename() != '.gitignore')
    {
        require_once __DIR__.'/routes/'.$file->getFilename();
    }
}

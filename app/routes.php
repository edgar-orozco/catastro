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

Route::resource('admin/tasa-predial','AdminTasaPredialController');

// Rutas para el administrado del Salario Mínimo Vigente
Route::resource('admin/smv','SalarioMinimoVigenteController');

// Rutas para el administrador de usuarios
Route::resource('admin/user','AdminUserController');

// Rutas para el administrador de permisos del sistema
Route::resource('admin/permission','AdminPermissionsController');

// Rutas para el administrador de roles del sistema
Route::resource('admin/role','AdminRolesController');


//Rutas para login, logout y profile
Route::controller( 'users', 'UsersController');

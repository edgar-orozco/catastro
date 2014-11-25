<?php


//Rutas del home.

Route::get('/', function()
{
    return View::make('hello');
});
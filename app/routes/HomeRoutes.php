<?php


//Rutas del home.
Route::get('/', array('as' => 'homepage', 'uses' => 'HomeController@showWelcome'));

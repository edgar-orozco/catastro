<?php

Route::get("Clavescobros/", "ClavesCobrosController@ObtenerValores");
Route::post("Clavescobros/", "ClavesCobrosController@ObtenerValores");

Route::get("agregarclave/", "ClavesCobrosController@CrearValores");
Route::post("agregarclave/", "ClavesCobrosController@CrearValores");


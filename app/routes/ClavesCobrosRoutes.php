<?php

Route::get("/Clavescobros", "ClavesCobrosController@ObtenerValores");
Route::post("/Clavescobros", "ClavesCobrosController@ObtenerValores");

Route::get("/agregarclave", "ClavesCobrosController@CrearValores");
Route::post("/agregarclave", "ClavesCobrosController@Crear");

Route::get("/Clavescobros", "ClavesCobrosController@getlistar");
//Route::post("/Clavescobros", "ClavesCobrosController@getlistar");

Route::get("/agregarclave", "ClavesCobrosController@listar");
Route::get("/agregarclave", "ClavesCobrosController@listar");
Route::get("/Clavescobros/{id?}", "ClavesCobrosController@eliminar");
Route::get("/agregarclave/{id?}", "ClavesCobrosController@eliminar");

Route::get("/editarclave/{id?}","ClavesCobrosController@update");
//Route::post("editarclave/{id?}","ClavesCobrosController@editar");
//Route::get("editarclave/{id?}", "ClavesCobrosController@editar");
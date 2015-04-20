<?php

Route::get("consultas/", "GeoController@getindex");
Route::post("consultas/", "GeoController@getindex");

Route::get("consultasmultiples/", "GeoController@getbusquedamultiple");
Route::post("consultasmultiples/", "GeoController@getbusquedamultiple");
Route::post("localidades/", "GeoController@postlocalidades");
Route::post("localidadesmun/", "GeoController@getmunicipio");




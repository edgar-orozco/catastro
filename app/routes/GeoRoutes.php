<?php

Route::get("consultas/", "GeoController@getindex");
Route::post("consultas/", "GeoController@getindex");

Route::get("consultasmultiples/", "GeoController@getbusquedamultiple");
Route::post("consultasmultiples/", "GeoController@getbusquedamultiple");



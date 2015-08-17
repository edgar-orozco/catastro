<?php

Route::get("salariominimo/", "IndicadoresController@crearSMV");
Route::post("salariominimo/", "IndicadoresController@crearSMV");

Route::get("obtenerinpc/", "IndicadoresController@crearINPC");
Route::post("obtenerinpc/", "IndicadoresController@crearINPC");
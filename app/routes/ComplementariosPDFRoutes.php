<?php

Route::post("complementospdf/","complementarios_ComplementariosPDFController@index");
Route::get("generarpdf/", "complementarios_ComplementariosPDFController@getdatos");

Route::get("generaranexos/", "complementarios_ComplementariosPDFController@getanexos");
Route::post("anexospdf/", "complementarios_ComplementariosPDFController@anexos");



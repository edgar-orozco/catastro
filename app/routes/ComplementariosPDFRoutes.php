<?php

Route::get("complementospdf/{id}","mapper_ComplementariosPDFController@index");
Route::get("generarpdf/", "mapper_ComplementariosPDFController@getdatos");

Route::get("generaranexos/", "mapper_ComplementariosPDFController@getanexos");
Route::post("anexospdf/", "mapper_ComplementariosPDFController@anexos");



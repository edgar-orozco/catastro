<?php

Route::get("complementospdf/{id}/{img}/{dir}/{num}/","mapper_ComplementariosPDFController@index");
Route::get("generarpdf/", "mapper_ComplementariosPDFController@getdatos");

Route::get("generaranexos/", "mapper_ComplementariosPDFController@getanexos");
Route::post("anexospdf/", "mapper_ComplementariosPDFController@anexos");



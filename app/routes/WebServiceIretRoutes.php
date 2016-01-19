<?php
Route::get('Iret/WebServiceInicio','WebServiceIretController@Index');
Route::get('Iret/BuscarVolante/{volante?}','WebServiceIretController@store');
Route::post('Iret/BuscarVolante', 'WebServiceIretController@store');
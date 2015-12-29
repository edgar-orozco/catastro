<?php

Route::get('/cajas/apertura', 'Cajas_CajasController@index');

Route::post('cajas/_list', 'Cajas_CajasController@create');

Route::get('/cajas/{id}/edit', 'Cajas_CajasController@edit');

Route::post('/cajas/{id}', 'Cajas_CajasController@update');

Route::get('/cajas/cierre', 'Cajas_CajasController@cierre');

Route::get('/cajas/cierrePdf', 'Cajas_CajasController@cierrePdf');
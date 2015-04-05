<?php

Route::resource('admin/smv','SalarioMinimoVigenteController');

Route::resource('cartografia/consultas','ConsultaMzPredio');

Route::resource('cartografia/consultajax','ConsultaAjax1');

Route::resource('cartografia/consultajax2','ConsultaAjax2');

Route::resource('cartografia/manzanas','ManzanasController');

Route::resource('cartografia/mapasajax','MapaAjaxController');

Route::resource('cartografia/consultamz','ConsultaMzPredioAlpha');

Route::resource('cartografia/xajax/loadmap','MapLoadController');

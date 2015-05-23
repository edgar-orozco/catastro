<?php

Route::resource('admin/smv', 'SalarioMinimoVigenteController');


Route::group(array('before' => 'consulta_cartografica'), function () {

    Route::resource('cartografia/consultas', 'ConsultaMzPredio');

    Route::resource('cartografia/consultajax', 'ConsultaAjax1');

    Route::resource('cartografia/consultajax2', 'ConsultaAjax2');

    Route::resource('cartografia/manzanas', 'ManzanasController');

    Route::resource('cartografia/mapasajax', 'MapaAjaxController');

    Route::resource('cartografia/consultamz', 'ConsultaMzPredioAlpha');

    Route::resource('cartografia/xajax/loadmap', 'MapLoadController');

    Route::resource('cartografia/xajax/consultaalfa', 'ConsultaAlfaController');

    Route::resource('cartografia/xajax/spatialquery', 'ConsultaEspacialController');

    Route::post("localidadByMpio", "ConsultasEspacialesController@postLocalidadByMpio");

    Route::post("mzaBylocalidad", "ConsultasEspacialesController@postMzaByLocalidad");

    Route::post("callesBylocalidad", "ConsultasEspacialesController@postCallesByLocalidad");

    Route::post("callesBycalle", "ConsultasEspacialesController@postCallesByCalle");

    Route::post("consultaCalle", "ConsultasEspacialesController@postConsultaCalle");

});


Route::filter('consulta_cartografica', function () {

    if (! ( Entrust::can('consulta_cartografica') ) )
    {
        return Redirect::to('/');
    }
});
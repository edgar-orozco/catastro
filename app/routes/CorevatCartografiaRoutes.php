<?php

Route::get('cartografia/corevat/', array(
    'as' => 'CorevatConsultaCartograficaController',
    'uses' => 'CorevatConsultaCartografica@index'
));

Route::group(array('before' => 'cartografia/corevat'), function () {

    Route::get('getAvaluoCartCorevat34_AA', array(
        'as' => 'CorevatConsultaCartograficaController',
        'uses' => 'CorevatConsultaCartografica@getMapa'
    ));

    Route::resource('cartografia/xajax/loadmap2', 'ConsultaEspacialPredioCorevatController');

    Route::resource('cartografia/xajax/consultaalfacorevat', 'ConsultaAlfaCorevatController');

    Route::post('cartografia/xajax/getmtcorevat', 'MTCorevatToPDFController@store');

	Route::post('cartografia/xajax/mtcorevat', 'MTCorevatToPDFController@index');

});




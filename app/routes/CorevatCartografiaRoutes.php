<?php

Route::get('cartografia/pininos/', array(
    'as' => 'CorevatConsultaCartograficaController',
    'uses' => 'CorevatConsultaCartografica@index'
));

Route::group(array('before' => 'cartografia/pininos'), function () {

    Route::get('getAvaluoCartCorevat34_AA', array(
        'as' => 'CorevatConsultaCartograficaController',
        'uses' => 'CorevatConsultaCartografica@getMapa'
    ));

    Route::resource('cartografia/xajax/loadmap2', 'ConsultaEspacialPredioCorevatController');

    Route::resource('cartografia/xajax/consultaalfacorevat', 'ConsultaAlfaCorevatController');


});





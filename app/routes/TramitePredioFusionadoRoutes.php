<?php

Route::group(array('before' => 'auth'), function () {
//Index
    Route::get('tramites/predio-fusionado',
      'TramitePredioFusionadoController@index');

    Route::post('tramites/predio-fusionado/store',
      ['uses' => 'TramitePredioFusionadoController@store']);

//Se muestra la tabla de predios que se involucran en la fusión.
    Route::get('tramites/predio-fusionado/show-grid',
      ['uses' => 'ValorCatastralController@showGrid']);

});
<?php
Route::group(array('before' => 'auth'), function () {
//Index
    Route::get('tramites/valor',
      'ValorCatastralController@index');

//Forma create
    Route::get('tramites/valor/create',
      'ValorCatastralController@create');

//Forma store
    Route::post('tramites/valor/create',
      ['uses' => 'ValorCatastralController@store']);

//Se muestra el resumen de valuación de un tramite
    Route::get('tramites/valor/show-grid',
      ['uses' => 'ValorCatastralController@showGrid']);

});
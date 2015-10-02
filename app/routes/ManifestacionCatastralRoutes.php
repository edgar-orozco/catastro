<?php
Route::group(array('before' => 'auth'), function () {
//Index
    Route::get('ofvirtual/notario/manifestacion',
      'ManifestacionCatastralController@index');

//Forma create
    Route::get('ofvirtual/notario/manifestacion/create',
      'ManifestacionCatastralController@create');

//Forma store
    Route::post('ofvirtual/notario/manifestacion/create',
      ['uses' => 'ManifestacionCatastralController@store']);

//Forma update
    Route::get('ofvirtual/notario/manifestacion/edit/{id}',
      ['as'=>'manifestacion.edit', 'uses' => 'ManifestacionCatastralController@edit']);

//Forma update
    Route::put('ofvirtual/notario/manifestacion/edit/{id}',
      ['as'=>'manifestacion.update', 'uses' => 'ManifestacionCatastralController@update']);
});
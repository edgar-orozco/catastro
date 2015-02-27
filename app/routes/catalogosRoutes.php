<?php //
Route::group(array('before'=>'admin'),  function (){
//Rutas para el catalago de status 
    Route::post('catalogos/status.{format}',
        array('as'=>'storeStatus','uses'=>'catalogos_statusController@store'));
    Route::get('catalogos/status.{format}',
        array('as' => 'indexStatus', 'uses' => 'catalogos_statusController@index'));
    Route::put('catalogos/status/{status}.{format}',
        array('as' => 'updateStatus', 'uses' => 'catalogos_statusController@update'));
    Route::resource('catalogos/status', 'catalogos_statusController');

//Rutas para el catalogo INPC
    Route::post('catalogos/inpc.{format}',
        array('as'=>'storeInpc','uses'=>'catalogos_inpcController@store'));
    Route::get('catalogos/inpc.{format}',
        array('as'=>'indexInpc','uses'=>'catalago_inpcController@index'));
    Route::put('catalogos/inpc/{id?}.{format}',
        array('as' => 'updateInpc', 'uses' => 'catalogos_inpcController@update'));
    Route::resource('catalogos/inpc', 'catalogos_inpcController');
    Route::get('catalogos/inpc/{id?}.{format}',
      array('as'=>'destroyInpc','use'=>'catalogos_inpcController@destroy'));
    
//Rutas para el catalogo Salario Minimo    
    Route::post('catalogos/salario.{format}',
        array('as'=>'storeSalario','uses'=>'catalogos_salarioController@store'));
    Route::get('catalogos/salario.{format}',
        array('as'=>'indexSalario','uses'=>'catalago_salarioController@index'));
    Route::put('catalogos/salario/{id?}.{format}',
        array('as' => 'updateSalario', 'uses' => 'catalogos_salarioController@update'));
    Route::resource('catalogos/salario', 'catalogos_salarioController');

//Rutas para el catalogo ejecutores    
    Route::post('catalogos/ejecutores.{format}',
        array('as'=>'storeEjecutores','uses'=>'catalogos_ejecutoresController@store'));
    Route::post('catalogos/ejecutores.{format}',
        array('as'=>'storeEjecutores','uses'=>'catalogos_ejecutoresController@buscar'));
    Route::get('catalogos/ejecutores.{format}',
        array('as'=>'indexEjecutores','uses'=>'catalago_ejecutoresController@index'));
    Route::put('catalogos/ejecutores/{id?}.{format}',
        array('as' => 'updateEjecutores', 'uses' => 'catalogos_ejecutoresController@update'));
    Route::resource('catalogos/ejecutores', 'catalogos_ejecutoresController');
    Route::get('search/autocomplete2', 'catalogos_ejecutoresController@autocomplete');
    
    
    Route::get('search/autocomplete', 'catalogos_personasController@getIndex');
//    Route::get('search/autocomplete2', 'catalogos_personasController@autocomplete');
    
    

});


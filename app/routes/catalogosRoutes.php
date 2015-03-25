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


    //Ruta para el orden de status 

    Route::post('/catalogos/status/orden',
        array('as' => 'ordenStatus', 'uses' => 'catalogos_statusController@ordenStatus'));

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
    Route::get('catalogos/inpcE/{id}',
        array('as' => 'destroyInpc', 'uses' => 'catalogos_inpcController@destroy'));
    
//Rutas para el catalogo Salario Minimo    
    Route::post('catalogos/salario.{format}',
        array('as'=>'storeSalario','uses'=>'catalogos_salarioController@store'));
    Route::get('catalogos/salario.{format}',
        array('as'=>'indexSalario','uses'=>'catalago_salarioController@index'));
    Route::put('catalogos/salario/{id?}.{format}',
        array('as' => 'updateSalario', 'uses' => 'catalogos_salarioController@update'));
    Route::resource('catalogos/salario', 'catalogos_salarioController');
    
    Route::get('catalogos/salarioE/{id}',
        array('as' => 'destroySalario', 'uses' => 'catalogos_salarioController@destroy'));

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
    Route::get('search/autocomplete1', 'catalogos_ejecutoresController@autocomplete');
    Route::get('catalogos/personas', 'catalogos_ejecutoresController@getIndex');
    Route::post('catalogos/personas','catalogos_ejecutoresController@storep');

//Rutas para el catalogo ejecucion
    Route::post('catalogos/configuracion{format}',
        array('as' => 'storeEjecucion', 'uses' => 'catalogos_configuracionController@store'));
    Route::get('catalogos/configuracion{format}',
        array('as' => 'indexEjecucion', 'uses' => 'catalogos_configuracionController@index'));
    Route::put('catalogos/configuracion/{ejecucion}.{format}',
        array('as' => 'updateEjecucion', 'uses' => 'catalogos_configuracionController@update'));
    Route::resource('catalogos/configuracion', 'catalogos_configuracionController');
    Route::post('catalogos/imagenes', 'catalogos_configuracionController@imagen');
    
    Route::get('catalogos/configuracionE/{id}',
        array('as' => 'destroyEjecucion', 'uses' => 'catalogos_configuracionController@destroy'));
});


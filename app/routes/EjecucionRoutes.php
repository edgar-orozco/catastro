<?php
/**
 * Rutas para ejecucion
 */


Route::group(array('before'=>'Ejecucion fiscal'),  function (){

    //Rutas para carga masiva

    Route::post('ejecucion/cargaEjecucion.{format}',
        array('as' => 'storeCargaEjecucion', 'uses' => 'ejecucion_cargaEjecucion_CargaEjecucionController@store'));

    Route::get('ejecucion/cargaEjecucion.{format}',
        array('as' => 'indexCargaEjecucion', 'uses' => 'ejecucion_cargaEjecucion_CargaEjecucionController@index'));

    Route::put('ejecucion/cargaEjecucion/{cargaEjecucion}.{format}',
        array('as' => 'updateCargaEjecucion', 'uses' => 'ejecucion_cargaEjecucion_CargaEjecucionController@update'));


    Route::resource('ejecucion/cargaEjecucion', 'ejecucion_cargaEjecucion_CargaEjecucionController');

});

 Route::filter('Ejecucion fiscal', function () {

    if (! ( Entrust::hasRole('Ejecucion fiscal') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});


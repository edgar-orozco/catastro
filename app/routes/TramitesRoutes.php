<?php


//Declaramos un grupo para aplicar las mismas reglas filtro 'admin'
//@see app/filters.php
Route::group(array('before' => 'admin'), function() {

    //Rutas para el administrador de catálogo de requisitos para trámites
    Route::post('admin/requisitos.{format}', array('as' => 'storeRequisito', 'uses' => 'RequisitosController@store'));
    Route::get('admin/requisitos.{format}', array('as' => 'indexRequisito', 'uses' => 'RequisitosController@index'));
    Route::put('admin/requisitos/{id}.{format}', array('as' => 'updateRequisito', 'uses' => 'RequisitosController@update'));
    Route::resource('admin/requisitos', 'RequisitosController');

    //Rutas para el administrador de catálogod de trámites
    Route::post('admin/tipotramites.{format}', array('as' => 'storeTipotramites', 'uses' => 'TipotramitesController@store'));
    Route::get('admin/tipotramites.{format}', array('as' => 'indexTipotramites', 'uses' => 'TipotramitesController@index'));
    Route::put('admin/tipotramites/{id}.{format}', array('as' => 'updateTipotramites', 'uses' => 'TipotramitesController@update'));
    Route::resource('admin/tipotramites', 'TipotramitesController');

});
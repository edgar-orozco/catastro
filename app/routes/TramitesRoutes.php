<?php

//Declaramos un grupo para aplicar las mismas reglas filtro 'admin'
//@see app/filters.php
Route::group(array('before' => 'admin'), function () {

    //Rutas para el administrador de catálogo de requisitos para trámites
    Route::post('admin/requisitos.{format}', array('as' => 'storeRequisito', 'uses' => 'RequisitosController@store'));
    Route::get('admin/requisitos.{format}', array('as' => 'indexRequisito', 'uses' => 'RequisitosController@index'));
    Route::put('admin/requisitos/{id}.{format}',
        array('as' => 'updateRequisito', 'uses' => 'RequisitosController@update'));
    Route::resource('admin/requisitos', 'RequisitosController');

    //Rutas para el administrador de catálogod de trámites
    Route::post('admin/tipotramites.{format}',
        array('as' => 'storeTipotramites', 'uses' => 'TipotramitesController@store'));
    Route::get('admin/tipotramites.{format}',
        array('as' => 'indexTipotramites', 'uses' => 'TipotramitesController@index'));
    Route::put('admin/tipotramites/{id}.{format}',
        array('as' => 'updateTipotramites', 'uses' => 'TipotramitesController@update'));
    Route::resource('admin/tipotramites', 'TipotramitesController');
    

});

//Ruta para la captura de documentos al iniciar un trámite.
Route::post(
    'ventanilla/solicitud-tramite',
    array(
        'as' => 'ventanilla.iniciar-tramite',
        'uses' => 'TramitesController@indexDocumentos',
        'before' => 'auth',
    )
);

Route::post(
    'ventanilla/iniciar-tramite',
    array(
        'as' => 'tramites.iniciar',
        'uses' => 'TramitesController@storeTramite',
        'before' => 'auth',
    )
);


//Proceso del tramite
Route::get(
    'tramites/proceso/{id}',
    array(
        'as' => 'tramite.proceso',
        'uses' => 'TramitesController@proceso',
        'before' => 'auth',
    )
);

Route::post(
    'tramites/proceso/{id}',
    array(
        'as' => 'tramite.proceso',
        'uses' => 'TramitesController@storeActividad',
        'before' => 'auth',
    )
);

//Ruta para manejar los archivos de los documentos.
Route::post(
    'tramites/documentos',
    array(
        'as' => 'tramites.documentos',
        'uses' => 'TramitesController@documentos',
        'before' => 'auth',
    )
);

Route::post(
    'tramites/documentos/eliminar',
    array(
        'as' => 'tramites.documentos.eliminar',
        'uses' => 'TramitesController@documentosEliminar',
        'before' => 'auth',
    )
);


//Búsqueda de trámites
Route::post(
    'tramites/buscar',
    array(
        'as' => 'tramite.buscar',
        'uses' => 'TramitesController@buscar',
        'before' => 'auth',
    )
);

//Carga tabla con trámites por atender por el usuario
Route::get(
    'tramites/poratender',
    array(
        'as' => 'tramites.poratender',
        'uses' => 'TramitesController@listaPorAtender',
        'before' => 'auth',
    )
);

//Carga tabla con tabla de archivos de documentos requeridos por tramite
Route::get(
    'tramite/lista/documentos/{tramite_id}/{requisito_id}',
    array(
        'as' => 'tramites.listadocs',
        'uses' => 'TramitesController@listaDocumentosTramite',
        'before' => 'auth',
    )
);

//Ruta para el recibo en pdf
    Route::get("ventanilla/recibo/{id}", "TramitesController@get_pdf");
    
//ruta para el Valor Catastral en pdf
    Route::get("ventanilla/valor", "TramitesController@valorCatastral");
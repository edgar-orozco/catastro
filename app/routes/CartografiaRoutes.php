<?php

Route::resource('admin/smv', 'SalarioMinimoVigenteController');


Route::group(array('before' => 'consulta_cartografica'), function () {

    Route::resource('cartografia/consultas', 'ConsultaCartografica');

    Route::resource('cartografia/manzanas', 'ManzanasController');

    Route::resource('cartografia/mapasajax', 'MapaAjaxController');

    Route::resource('cartografia/consultamz', 'ConsultaMzPredioAlpha');

    Route::resource('cartografia/xajax/loadmap', 'MapLoadController');

    Route::resource('cartografia/xajax/consultaalfa', 'ConsultaAlfaController');

    Route::resource('cartografia/xajax/spatialquery', 'ConsultaEspacialPredioController');

    Route::post("localidadByMpio", "ConsultasEspacialesController@postLocalidadByMpio");

    Route::post("mzaBylocalidad", "ConsultasEspacialesController@postMzaByLocalidad");

    Route::post("callesBylocalidad", "ConsultasEspacialesController@postCallesByLocalidad");

    Route::post("callesBycalle", "ConsultasEspacialesController@postCallesByCalle");

    Route::post("consultaCalle", "ConsultasEspacialesController@postConsultaCalle");

});


Route::filter('consulta_cartografica', function () {

    if (! ( Entrust::can('consulta_cartografica') ) )
    {
        return Redirect::to('/');
    }
});

/* Rutas para la carga de shapes
 */

Route::group(array('before' => 'cartografia'), function () {

    Route::get('admin/carga-shapes', array(
        'as' => 'admin.cargashapes',
        'uses' => 'CargaShapesController@index',
        'before' => 'auth'
    ));

    Route::any('admin/carga-shapes/upload', array(
        'as' => 'admin.cargashapes.upload',
        'uses' => 'CargaShapesController@upload',
        'before' => 'auth'
    ));

});

/*
 * Filtro para detección de roles de cartografía o permisos para actualizar la cartografia
 */
Route::filter('cartografia', function () {

    if (! ( Entrust::hasRole('Cartógrafo') ||  Entrust::can('actualizar_cartografia') ) ) // Checks the current user
    {
        return Redirect::to('/');
    }
});

/*
** Generación de productos
*/
Route::get("complementospdf/{id}/{img}/{dir?}/{num?}/","cedulaCatastralPDFController@index");
Route::get("generarpdf/", "cedulaCatastralPDFController@getdatos");

Route::get("generaranexos/", "cedulaCatastralPDFController@getanexos");
Route::post("anexospdf/", "cedulaCatastralPDFController@anexos");

/*
 * Percepción de Servicio
*/
Route::get('percepcionservicio', array(
    'as' => 'percepcionservicio',
    'uses' => 'PercepcionServicioController@index'
));

Route::post('storepercepcionservicio', 'PercepcionServicioController@store');


<?php
/**
 * Created by david.
 */

/**
 * Rutas para la carga de shapes
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
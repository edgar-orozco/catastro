<?php
/**
 * Created by david.
 */

/**
 * Rutas para la carga de shapes
 */

Route::group(array('before' => 'admin'), function () {

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
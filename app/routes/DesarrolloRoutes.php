<?php
/**
 * Rutas para ayuda en el desarrollo, estas rutas solo aplican para el servidor staging
 */

Route::group(array('before' => 'admin'), function () {

    //Para ejecutar seeds en el servidor
    Route::get('admin/ejecuta-seeds', array(
        'as' => 'admin.ejecuta-seeds',
        'uses' => 'DesarrolloController@seedsIndex',
        'before' => 'auth'
    ));

    Route::post('admin/ejecuta-seeds', array(
        'as' => 'admin.ejecuta-seeds',
        'uses' => 'DesarrolloController@ejecutaSeed',
        'before' => 'auth'
    ));

});

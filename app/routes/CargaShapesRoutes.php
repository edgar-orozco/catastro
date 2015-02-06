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
        'uses' => 'ProfileController@index',
        'before' => 'auth'
    ));

});
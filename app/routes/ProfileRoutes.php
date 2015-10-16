<?php
/**
 * Created by David.
 */

/**
 * Rutas para el profile del usuario
 */

Route::get('profile/mis-datos', array(
    'as'     => 'profle.mis-datos',
    'uses'   => 'ProfileController@index',
    'before' => 'auth'
));

Route::get('profile/editar', array(
    'as'        => 'profle.editar',
    'uses'      => 'ProfileController@edit',
    'before'    => 'auth'
));

Route::put('profile/editar/{user}.{format}', array(
    'as'        => 'profle.update',
    'uses'      => 'AdminUserController@update',
    'before'    => 'auth'
));

// Ruta para actualizar el logo de un usuario
Route::post('admin/user-logo/{user}.{format}',array(
    'as'        => 'updateLogo',
    'uses'      => 'admin_usuarioLogoController@update',
    'before'    => 'auth'
));
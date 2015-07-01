<?php
Route::group(array('before'=>'admin'), function (){
    // Rutas para el administrador de usuarios de notaria
    Route::post('admin/usuarios/notaria.{format}',
        array('as' => 'storeUserNotaria', 'uses' => 'admin_usuarioNotariaController@store'));
    Route::get('admin/usuarios/notaria.{format}',
        array('as' => 'indexUserNotaria', 'uses' => 'admin_usuarioNotariaController@index'));
    Route::get('admin/usuarios/notarias',
        array('as' => 'getUsersNotaria', 'uses' => 'admin_usuarioNotariaController@all'));
    Route::put('admin/usuarios/notaria/{user}.{format}',
        array('as' => 'updateUserNotaria', 'uses' => 'admin_usuarioNotariaController@update'));
    Route::put('admin/usuarios/notaria/{user}/active',
        array('as' => 'activeUserNotaria', 'uses' => 'admin_usuarioNotariaController@active'));

    Route::resource('admin/usuarios/notaria', 'admin_usuarioNotariaController');
});
        




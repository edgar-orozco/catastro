<?php
Route::group(array('before'=>'admin'), function (){
    // Rutas para el administrador de usuarios perito
    Route::post('admin/usuarios/perito.{format}',
        array('as' => 'storeUserPerito', 'uses' => 'admin_usuarioPeritoController@store'));
    Route::get('admin/usuarios/perito.{format}',
        array('as' => 'indexUserPerito', 'uses' => 'admin_usuarioPeritoController@index'));
    Route::get('admin/usuarios/peritos',
        array('as' => 'getUsersPerito', 'uses' => 'admin_usuarioPeritoController@all'));
    Route::put('admin/usuarios/perito/{user}.{format}',
        array('as' => 'updateUserPerito', 'uses' => 'admin_usuarioPeritoController@update'));
    Route::put('admin/usuarios/perito/{user}/active',
        array('as' => 'activeUserPerito', 'uses' => 'admin_usuarioPeritoController@active'));

    Route::resource('admin/usuarios/perito', 'admin_usuarioPeritoController');
});


<?php

//Declaramos un grupo para aplicar las mismas reglas filtro 'admin'
//@see app/filters.php
Route::group(array('before' => 'admin'), function () {

    // Rutas para el administrador de usuarios
    Route::get('admin/auditor',
        array('as' => 'indexUser', 'uses' => 'admin_AuditorAdminUsuariosController@index'));
    Route::get('admin/auditor/consulta',
        array('as' => 'consulta', 'uses' => 'admin_AuditorAdminUsuariosController@consulta'));
    Route::get('admin/auditor/filtros',
        array('as' => 'filtros', 'uses' => 'admin_AuditorAdminUsuariosController@filtros'));

    Route::resource('admin/auditor', 'admin_AuditorAdminUsuariosController');
});
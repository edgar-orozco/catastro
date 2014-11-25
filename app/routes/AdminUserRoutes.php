<?php

//Declaramos un grupo para aplicar las mismas reglas filtro 'admin'
//@see app/filters.php
Route::group(array('before' => 'admin'), function() {

    // Rutas para el administrador de usuarios
    Route::resource('admin/user', 'AdminUserController');

    // Rutas para el administrador de permisos del sistema
    Route::resource('admin/permission', 'AdminPermissionsController');

    // Rutas para el administrador de roles del sistema
    Route::resource('admin/role', 'AdminRolesController');

});
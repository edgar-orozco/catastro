<?php
Route::group(array('before' => 'admin'), function () {
    // Rutas para el auditor del log de laravel
    Route::get('admin/laravel-log', 'AuditarLogController@index');
});

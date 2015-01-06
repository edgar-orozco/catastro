<?php
/**
 * Rutas para atención de trámites en ventanilla
 */

Route::get('ventanilla/primera-atencion', array(
    'as' => 'ventanilla.primera-atencion',
    'uses' => 'VentanillaController@index',
    'before' => 'auth'
));
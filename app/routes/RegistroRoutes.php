<?php
/**
 * Rutas para registro de usuarios virtuales
 */

Route::get('registro/primera-atencion', array(
    'as' => 'registro.primera-atencion',
    'uses' => 'RegistroController@index'
));
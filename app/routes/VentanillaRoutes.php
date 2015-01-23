<?php
/**
 * Rutas para atención de trámites en ventanilla
 */

Route::get('ventanilla/primera-atencion', array(
    'as' => 'ventanilla.primera-atencion',
    'uses' => 'VentanillaController@index',
    'before' => 'auth'
));

/** Obtiene un registro catastral del padron fiscal mediante su clave o cuenta */
Route::get('ventanilla/consulta-padron', array(
    'as' => 'ventanilla.consulta-padron',
    'uses' => 'VentanillaController@getFiscalByClaveCatastral',
    'before' => 'auth',
));

App::bind('\Catastro\Repos\Padron\PadronRepositoryInterface', '\Catastro\Repos\Padron\PadronFiscalRepository');
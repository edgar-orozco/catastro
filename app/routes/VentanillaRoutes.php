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

/** Almacena los intentos de trámite, operación que se realiza cuando el ciudadano no presenta todos los requerimientos necesarios para el trámite **/
Route::post('ventanilla/intento-tramite', array(
    'as' => 'ventanilla.intento-tramite',
    'uses' => 'VentanillaController@storeIntento',
    'before' => 'auth',
));

App::bind('\Catastro\Repos\Padron\PadronRepositoryInterface', '\Catastro\Repos\Padron\PadronFiscalRepository');
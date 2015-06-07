<?php
/**
 * Rutas para el lock screen
 */

Route::get('/lock-screen', array(
    'as' => 'lockscreen',
    'uses' => 'LockScreenController@session',
    'before' => 'auth'
));
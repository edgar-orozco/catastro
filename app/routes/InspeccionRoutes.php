<?php
Route::group(array('before' => 'auth'), function () {


//Forma create
 Route::get('tramite/inspeccion/create',
      'InspeccionController@create');



});
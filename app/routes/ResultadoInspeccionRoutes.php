<?php

//Route::group(array('before' => 'admin', 'before' => 'ventanilla'), function () {

	    Route::resource('tramites/inspeccion/resultado', 'tramites_ResultadoInspeccionController');
		Route::resource('tramites/inspeccion/solicitud','tramites_SolicitarInspeccionController');
    Route::post('tramites/inspeccion/solicitud/store','tramites_SolicitarInspeccionController@store');



//});
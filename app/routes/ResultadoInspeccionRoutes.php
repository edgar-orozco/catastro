<?php

Route::group(array('before' => 'admin'), function () {

	    Route::resource('tramites/inspeccion/resultado', 'tramites_ResultadoInspeccionController@create');
		Route::resource('tramites/inspeccion/solicitud','tramites_SolicitarInspeccionController@create');

    

});
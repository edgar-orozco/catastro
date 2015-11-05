<?php

Route::group(array('before' => 'admin'), function () {

	    Route::resource('tramites/resultadoInspeccion', 'tramites_ResultadoInspeccionController');
    

});
<?php
Route::group(array('before'=>'Ejecucion fiscal'),  function (){


//ruta prueba
Route::get("/configuracion", "Ejecucion_BuscaController@configuracion");
//pantalla principal de carta invvitacion
Route::post("/ejecucion/", "Ejecucion_BuscarController@getIndex");
//Route::get("/ejecucion/", "Ejecucion_BuscarController@getIndex");
Route::controller("/ejecuciones", "Ejecucion_BuscaController");
//pantalla principal de seguimiento ejecucion
Route::get("/seguimiento", "Ejecucion_SeguimientoController@getIndex");
Route::post("/busquedas", "Ejecucion_SeguimientobusController@getIndex");
Route::get("/busquedas", "Ejecucion_SeguimientobusController@getIndex");
//vista para capturar datos ejecucion fiscal
Route::get('/vista', function()
{
	 return View::make('ejecucion.carta');
});
//ruta para pdf
Route::post("/cartainv/{clave?}/{date1?}", "CartaInvitacion_PdfController@get_pdf");
Route::get("/reimprimircarta/{clave?}/{date1?}", "CartaInvitacion_PdfController@reimpresion");
//ruta validar fecha
Route::post("/validar", "Ejecucion_SeguimientobusController@validar");

//Route::controller("/consulta", "Consulta_ConsultaController");
Route::get("/consulta", "Consulta_ConsultaController@pdf");
//rutas modal agregar notificacion
 Route::get('/ejecucion/modal/{idrequerimiento}', 'Ejecucion_SeguimientobusController@modal');
 Route::post('/ejecucion/guardar', 'Ejecucion_SeguimientobusController@update');

// rutas modal cancelacion
 Route::get('/ejecucion/cancelar/{idreq}', 'Ejecucion_SeguimientobusController@cancelar');
 Route::post('/ejecucion/guardarcancelacion', 'Ejecucion_SeguimientobusController@guardarcancelacion');

//rutas de prueba para pdf :
Route::get("/pruebapdf/{clave?}", "CartaInvitacion_pdfpruebaController@getIndex");
Route::get("/reimprimir/{clave?}", "CartaInvitacion_PdfpruebaController@imprimir");

    });


 Route::filter('Ejecucion fiscal', function () {

    if (! ( Entrust::hasRole('Ejecucion fiscal') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});



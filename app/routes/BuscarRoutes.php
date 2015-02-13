<?php
//pantalla principal de ejecucion
Route::controller("/ejecucion", "Ejecucion_BuscarController");
//vista para capturar datos ejecucion fiscal
Route::get('/vista', function()
{
	 return View::make('ejecucion.carta');
});
//ruta para pdf
Route::post("/cartainv/{clave?}/{date1?}", "CartaInvitacion_PdfController@get_pdf");

Route::controller("/consulta", "Consulta_ConsultaController");

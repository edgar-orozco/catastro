<?php
//pantalla principal de ejecucion
Route::controller("/buscar", "Ejecucion_BuscarController");
//vista para capturar datos ejecucion fiscal
Route::get('/vista', function()
{
	 return View::make('ejecucion.carta');
});
//ruta para pdf
Route::post("/hoja/{clave?}/{date1?}", "Mostrar_HojaController@get_pdf");















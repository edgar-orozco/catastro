<?php
Route::group(array('before'=>'Folios'),  function (){
  //Route::Metodo de envio('/direccion que aparecera en la barra de direccion', controlador@objeto del controlador);
		/* -- FILTRO DE USUARIO MUNICIPIO, NO PODRÁ ACCEDER A ESTAS RUTAS -- */
		
			Route::get('/index', 'folios_IndexController@index');
		
			Route::get('/nfolios', 'folios_FoliosController@nfolios');
			Route::get('/foliosemitidos', 'folios_FoliosController@foliosemitidos');
			Route::post('/nfolios', 'folios_FoliosController@nfolioscreate');
			
			Route::get('nfolios/formato/{id}', 'folios_FoliosController@formato');
			Route::get('formato/{id}', 'folios_FoliosController@formato');
			Route::get('eliminarFolio/{id}', 'folios_FoliosController@eliminarFolios');
			
			Route::get('/entregafoliosestatal', 'folios_EntregaFoliosController@entregafoliosestatal');
			Route::get('/entregafoliose/detalles/{id}', 'folios_EntregaFoliosController@detalles');
			Route::get('/entregafoliose/urbanos/{id}', 'folios_EntregaFoliosController@get_urbanose');
			Route::get('/entregafoliose/rusticos/{id}', 'folios_EntregaFoliosController@get_rusticose');
			Route::post('/entregafoliose/urbanos/{id}', 'folios_EntregaFoliosController@post_foliose');
			Route::post('/entregafoliose/rusticos/{xid}', 'folios_EntregaFoliosController@post_foliose');
			
			Route::get('/reporteperito', 'folios_FoliosController@reporteperito');			
			Route::get('/formatoreporteperito', 'folios_FoliosController@formatoreporteperito');
			Route::get('/reportemensual', 'folios_FoliosController@reportemensual');
			Route::get('/reportetotal', 'folios_FoliosController@reportetotal');
			Route::get('/formatoreportetotal', 'folios_FoliosController@formatoreportetotal');
		
		/* -- FILTRO DE USUARIO SECRETARIA, NO PODRÁ ACCEDER A ESTAS RUTAS -- */
		
			Route::get('/configuraciones', 'folios_ConfController@index');
			Route::post('/configuraciones', 'folios_ConfController@modificar');
			Route::resource('catalogos/usuarios', 'folios_CatUsuariosController');
			Route::get('catalogos/usuarios/status/{id}', 'folios_CatUsuariosController@status');
	 		
	 		Route::get('catalogos/peritos/tablaperitos', 'folios_PeritosController@tablaperitos');
	 		Route::get('catalogos/peritos/estado/{id}', 'folios_PeritosController@DesPerito');
	 		Route::get('catalogos/peritos/nuevoPerito', 'folios_PeritosController@get_nuevoPerito');
	 		Route::post('catalogos/peritos/nuevoPerito', 'folios_PeritosController@post_nuevoPerito');
	 		Route::get('catalogos/peritos/actPerito/{id}', 'folios_PeritosController@get_actPerito');
			Route::post('catalogos/peritos/actPerito', 'folios_PeritosController@post_nuevoPerito');
		
		Route::get('/entregafoliosmunicipal', 'folios_EntregaFoliosController@entregafoliosmunicipal');
		Route::get('/entregafoliosm/urbanos/{id}', 'folios_EntregaFoliosController@get_urbanosm');
		Route::get('/entregafoliosm/rusticos/{id}', 'folios_EntregaFoliosController@get_rusticosm');
		Route::post('/entregafoliosm/urbanos/{id}', 'folios_EntregaFoliosController@post_foliosm');
		Route::post('/entregafoliosm/rusticos/{id}', 'folios_EntregaFoliosController@post_foliosm');
});
 Route::filter('Folios', function () {
    if (! ( Entrust::hasRole('Folios') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});
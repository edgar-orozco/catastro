<?php
//Folio Admin
Route::group(array('before'=>'Folios'),  function (){
                        /* -- FILTRO DE USUARIO MUNICIPIO, NO PODRÁ ACCEDER A ESTAS RUTAS -- */
                        Route::get('/index', 'folios_IndexController@index');
		
			Route::get('/nfolios', 'folios_FoliosController@nfolios');
			Route::get('/foliosemitidos', 'folios_FoliosController@foliosemitidos');
			Route::post('/foliosemitidos', 'folios_FoliosController@foliosemitidos');
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

			//REPORTE PERITO
			Route::get('/reporteperito', 'folios_FoliosController@reporteperito');			
			Route::get('/formatoreporteperito', 'folios_FoliosController@formatoreporteperito');
			Route::get('/formatoreporteperito2', 'folios_FoliosController@formatoreporteperito2');

			//REPORTE MENSUAL
			Route::get('/reportemensual', 'folios_reportes_MensualController@reportemensual');
			Route::get('/formatoreportemensual', 'folios_reportes_MensualController@formatoreportemensual');
			Route::get('/formatoreportemensual/grafica', 'folios_reportes_MensualController@grafica');

			//REPORTE TOTAL
			Route::get('/reportetotal', 'folios_FoliosController@reportetotal');
			Route::get('/formatoreportetotal', 'folios_FoliosController@formatoreportetotal');

			//REPORTE MUNICIPIO
            Route::get('/reporte/municipio', 'folios_reportes_MunicipioController@index');
            Route::get('/reporte/municipio/{id}', 'folios_reportes_MunicipioController@municipio_detalles');
            Route::get('/grafica', 'folios_reportes_MunicipioController@municipio_grafica');

					
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

            //Deshabilitar entrega municipal
            Route::get('/entregafoliose/rusticos/habilitarm/{id}', 'folios_EntregaFoliosController@desmunicipior');
            Route::get('/entregafoliose/urbanos/habilitarm/{id}', 'folios_EntregaFoliosController@desmunicipiou');

            //Deshabilitar entrega Estatal
            Route::get('/entregafoliose/rusticos/habilitare/{id}', 'folios_EntregaFoliosController@desestador');
            Route::get('/entregafoliose/urbanos/habilitare/{id}', 'folios_EntregaFoliosController@desestadou');

            //Consultas
            Route::get('/consultas/db/query', 'folios_FoliosController@getquerys');
            Route::post('/consultas/db/query', 'folios_FoliosController@querys');

});
 Route::filter('Folios', function () {
    if (! ( Entrust::hasRole('Folios') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});

//folio usuario
Route::group(array('before'=>'Folios usuario'),  function (){
  //Route::Metodo de envio('/direccion que aparecera en la barra de direccion', controlador@objeto del controlador);

		/* -- FILTRO DE USUARIO MUNICIPIO, NO PODRÁ ACCEDER A ESTAS RUTAS -- */
			Route::get('/index', 'folios_IndexController@index');
                        //Nuevo Folio		
			Route::get('/nfolios', 'folios_FoliosController@nfolios');
			Route::post('/nfolios', 'folios_FoliosController@nfolioscreate');
			Route::get('nfolios/formato/{id}', 'folios_FoliosController@formato');
			//Folios Emitidos
                        Route::get('/foliosemitidos', 'folios_FoliosController@foliosemitidos');
			Route::get('formato/{id}', 'folios_FoliosController@formato');
			Route::get('eliminarFolio/{id}', 'folios_FoliosController@eliminarFolios');
                        //Entrega Folios Estatal
			Route::get('/entregafoliosestatal', 'folios_EntregaFoliosController@entregafoliosestatal');
			Route::get('/entregafoliose/detalles/{id}', 'folios_EntregaFoliosController@detalles');
			Route::get('/entregafoliose/urbanos/{id}', 'folios_EntregaFoliosController@get_urbanose');
			Route::get('/entregafoliose/rusticos/{id}', 'folios_EntregaFoliosController@get_rusticose');
			Route::post('/entregafoliose/urbanos/{id}', 'folios_EntregaFoliosController@post_foliose');
			Route::post('/entregafoliose/rusticos/{xid}', 'folios_EntregaFoliosController@post_foliose');

			//Deshabilitar entrega municipal
            Route::get('/entregafoliose/rusticos/habilitarm/{id}', 'folios_EntregaFoliosController@desmunicipior');
            Route::get('/entregafoliose/urbanos/habilitarm/{id}', 'folios_EntregaFoliosController@desmunicipiou');

            //Deshabilitar entrega Estatal
            Route::get('/entregafoliose/rusticos/habilitare/{id}', 'folios_EntregaFoliosController@desestador');
            Route::get('/entregafoliose/urbanos/habilitare/{id}', 'folios_EntregaFoliosController@desestadou');
});
 Route::filter('Folio usuario', function () {

    if (! ( Entrust::hasRole('Folio usuario') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});

//Usuario municipio
 Route::group(array('before'=>'Folios municipio'),  function (){ 
                        //peritos
	 	Route::get('/entregafoliosmunicipal', 'folios_EntregaFoliosController@entregafoliosmunicipal');
		Route::get('/entregafoliosm/urbanos/{id}', 'folios_EntregaFoliosController@get_urbanosm');
		Route::get('/entregafoliosm/rusticos/{id}', 'folios_EntregaFoliosController@get_rusticosm');
		Route::post('/entregafoliosm/urbanos/{id}', 'folios_EntregaFoliosController@post_foliosm');
		Route::post('/entregafoliosm/rusticos/{id}', 'folios_EntregaFoliosController@post_foliosm');
});

 Route::filter('Folios municipio', function () {

    if (! ( Entrust::hasRole('Folios municipio','Folios') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});
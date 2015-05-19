<?php

Route::group(array('before' => 'admin'), function () {
	/*
	 * CATALOGO DE EMPRESAS
	 * empresas
	 */
	Route::resource('corevat/Empresas', 'corevat_EmpresasController');

	Route::get('corevat/Empresas.{format}', array('as' => 'indexEmpresas', 'uses' => 'corevat_EmpresasController@index'));

	Route::put('corevat/Empresas/{id?}.{format}', array('as' => 'showEmpresas', 'uses' => 'corevat_EmpresasController@show'));

	Route::post('corevat/Empresas.{format}', array('as' => 'storeEmpresas', 'uses' => 'corevat_EmpresasController@store'));

	Route::put('corevat/Empresas/{id?}.{format}', array('as' => 'updateEmpresas', 'uses' => 'corevat_EmpresasController@update'));

	Route::get('corevat/EmpresasE/{id}', array('as' => 'destroyEmpresas', 'uses' => 'corevat_EmpresasController@destroy'));

	/*
	 * CATALOGO DE ESTADOS
	 * estados
	 */
	Route::resource('corevat/Estados', 'corevat_EstadosController');

	Route::get('corevat/Estados.{format}', array('as' => 'indexEstados', 'uses' => 'corevat_EstadosController@index'));

	Route::put('corevat/Estados/{id?}.{format}', array('as' => 'showEstados', 'uses' => 'corevat_EstadosController@show'));

	Route::post('corevat/Estados.{format}', array('as' => 'storeEstados', 'uses' => 'corevat_EstadosController@store'));

	Route::put('corevat/Estados/{id?}.{format}', array('as' => 'updateEstados', 'uses' => 'corevat_EstadosController@update'));

	Route::get('corevat/EstadosE/{id}', array('as' => 'destroyEstados', 'uses' => 'corevat_EstadosController@destroy'));


	/*
	 * CATALOGO DE MUNICIPIOS
	 * municipios
	 */
	Route::resource('corevat/Municipios', 'corevat_MunicipiosController');

	Route::get('corevat/Municipios.{format}', array('as' => 'indexMunicipios', 'uses' => 'corevat_MunicipiosController@index'));

	Route::put('corevat/Municipios/{id?}.{format}', array('as' => 'showMunicipios', 'uses' => 'corevat_MunicipiosController@show'));

	Route::post('corevat/Municipios.{format}', array('as' => 'storeMunicipios', 'uses' => 'corevat_MunicipiosController@store'));

	Route::put('corevat/Municipios/{id?}.{format}', array('as' => 'updateMunicipios', 'uses' => 'corevat_MunicipiosController@update'));

	Route::get('corevat/MunicipiosE/{id}', array('as' => 'destroyMunicipios', 'uses' => 'corevat_MunicipiosController@destroy'));


	/*
	 * CATALOGO DE APLANADOS
	 * cat_aplanados
	 */
	Route::resource('corevat/CatAplanados', 'corevat_CatAplanadosController');

	Route::get('corevat/CatAplanados.{format}', array('as' => 'indexCatAplanados', 'uses' => 'corevat_CatAplanadosController@index'));

	Route::put('corevat/CatAplanados/{id?}.{format}', array('as' => 'showCatAplanados', 'uses' => 'corevat_CatAplanadosController@show'));

	Route::post('corevat/CatAplanados.{format}', array('as' => 'storeCatAplanados', 'uses' => 'corevat_CatAplanadosController@store'));

	Route::put('corevat/CatAplanados/{id?}.{format}', array('as' => 'updateCatAplanados', 'uses' => 'corevat_CatAplanadosController@update'));

	Route::get('corevat/CatAplanadosE/{id}', array('as' => 'destroyCatAplanados', 'uses' => 'corevat_CatAplanadosController@destroy'));


	/*
	 * CATALOGO DE BARDAS
	 * cat_bardas
	 */
	Route::resource('corevat/CatBardas', 'corevat_CatBardasController');

	Route::post('corevat/CatBardas.{format}', array('as' => 'storeCatBardas', 'uses' => 'corevat_CatBardasController@store'));

	Route::get('corevat/CatBardas.{format}', array('as' => 'indexCatBardas', 'uses' => 'corevat_CatBardasController@index'));

	Route::put('corevat/CatBardas/{id?}.{format}', array('as' => 'updateCatBardas', 'uses' => 'corevat_CatBardasController@update'));

	Route::get('corevat/CatBardas/{id}', array('as' => 'destroyCatBardas', 'uses' => 'corevat_CatBardasController@destroy'));

	Route::put('corevat/CatBardas/{id?}.{format}', array('as' => 'showCatBardas', 'uses' => 'corevat_CatBardasController@show'));


	/*
	 * CATALOGO DE CALIDAD DE PROYECTO
	 * cat_calidad_proyecto
	 */
	Route::resource('corevat/CatCalidadProyecto', 'corevat_CatCalidadProyectoController');

	Route::post('corevat/CatCalidadProyecto.{format}', array('as' => 'storeCatCalidadProyecto', 'uses' => 'corevat_CatCalidadProyectoController@store'));

	Route::get('corevat/CatCalidadProyecto.{format}', array('as' => 'indexCatCalidadProyecto', 'uses' => 'corevat_CatCalidadProyectoController@index'));

	Route::put('corevat/CatCalidadProyecto/{id?}.{format}', array('as' => 'updateCatCalidadProyecto', 'uses' => 'corevat_CatCalidadProyectoController@update'));

	Route::get('corevat/CatCalidadProyectoE/{id}', array('as' => 'destroyCatCalidadProyecto', 'uses' => 'corevat_CatCalidadProyectoController@destroy'));

	Route::put('corevat/CatCalidadProyecto/{id?}.{format}', array('as' => 'showCatCalidadProyecto', 'uses' => 'corevat_CatCalidadProyectoController@show'));


	/*
	 * CATALOGO DE CIMENTACIONES
	 * cat_cimentaciones
	 */
	Route::resource('corevat/CatCimentaciones', 'corevat_CatCimentacionesController');

	Route::post('corevat/CatCimentaciones.{format}', array('as' => 'storeCatCimentaciones', 'uses' => 'corevat_CatCimentacionesController@store'));

	Route::get('corevat/CatCimentaciones.{format}', array('as' => 'indexCatCimentaciones', 'uses' => 'corevat_CatCimentacionesController@index'));

	Route::put('corevat/CatCimentaciones/{id?}.{format}', array('as' => 'updateCatCimentaciones', 'uses' => 'corevat_CatCimentacionesController@update'));

	Route::get('corevat/CatCimentacionesE/{id}', array('as' => 'destroyCatCimentaciones', 'uses' => 'corevat_CatCimentacionesController@destroy'));

	Route::put('corevat/CatCimentaciones/{id?}.{format}', array('as' => 'showCatCimentaciones', 'uses' => 'corevat_CatCimentacionesController@show'));


	/*
	 * CATALOGO DE CLASE GENERAL DEL PROYECTO
	 * cat_clase_general_inmuebleç
	 */
	Route::resource('corevat/CatClaseGeneralInmueble', 'corevat_CatClaseGeneralInmuebleController');

	Route::post('corevat/CatClaseGeneralInmueble.{format}', array('as' => 'storeCatClaseGeneralInmueble', 'uses' => 'corevat_CatClaseGeneralInmuebleController@store'));

	Route::get('corevat/CatClaseGeneralInmueble.{format}', array('as' => 'indexCatClaseGeneralInmueble', 'uses' => 'corevat_CatClaseGeneralInmuebleController@index'));

	Route::put('corevat/CatClaseGeneralInmueble/{id?}.{format}', array('as' => 'updateCatClaseGeneralInmueble', 'uses' => 'corevat_CatClaseGeneralInmuebleController@update'));

	Route::get('corevat/CatClaseGeneralInmuebleE/{id}', array('as' => 'destroyCatClaseGeneralInmueble', 'uses' => 'corevat_CatClaseGeneralInmuebleController@destroy'));

	Route::put('corevat/CatClaseGeneralInmueble/{id?}.{format}', array('as' => 'showCatClaseGeneralInmueble', 'uses' => 'corevat_CatClaseGeneralInmuebleController@show'));


	/*
	 * CATALOGO DE CLASIFICACION DE ZONA
	 * cat_clasificacion_zona
	 */
	Route::resource('corevat/CatClasificacionZona', 'corevat_CatClasificacionZonaController');

	Route::post('corevat/CatClasificacionZona.{format}', array('as' => 'storeCatClasificacionZona', 'uses' => 'corevat_CatClasificacionZonaController@store'));

	Route::get('corevat/CatClasificacionZona.{format}', array('as' => 'indexCatClasificacionZona', 'uses' => 'corevat_CatClasificacionZonaController@index'));

	Route::put('corevat/CatClasificacionZona/{id?}.{format}', array('as' => 'updateCatClasificacionZona', 'uses' => 'corevat_CatClasificacionZonaController@update'));

	Route::get('corevat/CatClasificacionZonaE/{id}', array('as' => 'destroyCatClasificacionZona', 'uses' => 'corevat_CatClasificacionZonaController@destroy'));

	Route::put('corevat/CatClasificacionZona/{id?}.{format}', array('as' => 'showCatClasificacionZona', 'uses' => 'corevat_CatClasificacionZonaController@show'));


	/*
	 * CATALOGO DE CONSTRUCCIONES
	 * cat_construcciones
	 */
	Route::resource('corevat/CatConstrucciones', 'corevat_CatConstruccionesController');

	Route::post('corevat/CatConstrucciones.{format}', array('as' => 'storeCatConstrucciones', 'uses' => 'corevat_CatConstruccionesController@store'));

	Route::get('corevat/CatConstrucciones.{format}', array('as' => 'indexCatConstrucciones', 'uses' => 'corevat_CatConstruccionesController@index'));

	Route::put('corevat/CatConstrucciones/{id?}.{format}', array('as' => 'updateCatConstrucciones', 'uses' => 'corevat_CatConstruccionesController@update'));

	Route::get('corevat/CatConstruccionesE/{id}', array('as' => 'destroyCatConstrucciones', 'uses' => 'corevat_CatConstruccionesController@destroy'));

	Route::put('corevat/CatConstrucciones/{id?}.{format}', array('as' => 'showCatConstrucciones', 'uses' => 'corevat_CatConstruccionesController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_entrepisos
	 */
	Route::resource('corevat/CatEntrepisos', 'corevat_CatEntrepisosController');

	Route::post('corevat/CatEntrepisos.{format}', array('as' => 'storeCatEntrepisos', 'uses' => 'corevat_CatEntrepisosController@store'));

	Route::get('corevat/CatEntrepisos.{format}', array('as' => 'indexCatEntrepisos', 'uses' => 'corevat_CatEntrepisosController@index'));

	Route::put('corevat/CatEntrepisos/{id?}.{format}', array('as' => 'updateCatEntrepisos', 'uses' => 'corevat_CatEntrepisosController@update'));

	Route::get('corevat/CatEntrepisosE/{id}', array('as' => 'destroyCatEntrepisos', 'uses' => 'corevat_CatEntrepisosController@destroy'));

	Route::put('corevat/CatEntrepisos/{id?}.{format}', array('as' => 'showCatEntrepisos', 'uses' => 'corevat_CatEntrepisosController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_estado_conservacion
	 */
	Route::resource('corevat/CatEstadoConservacion', 'corevat_CatEstadoConservacionController');

	Route::post('corevat/CatEstadoConservacion.{format}', array('as' => 'storeCatEstadoConservacion', 'uses' => 'corevat_CatEstadoConservacionController@store'));

	Route::get('corevat/CatEstadoConservacion.{format}', array('as' => 'indexCatEstadoConservacion', 'uses' => 'corevat_CatEstadoConservacionController@index'));

	Route::put('corevat/CatEstadoConservacion/{id?}.{format}', array('as' => 'updateCatEstadoConservacion', 'uses' => 'corevat_CatEstadoConservacionController@update'));

	Route::get('corevat/CatEstadoConservacionE/{id}', array('as' => 'destroyCatEstadoConservacion', 'uses' => 'corevat_CatEstadoConservacionController@destroy'));

	Route::put('corevat/CatEstadoConservacion/{id?}.{format}', array('as' => 'showCatEstadoConservacion', 'uses' => 'corevat_CatEstadoConservacionController@show'));


	/*
	 * CATALOGO DE ESTRUCTURAS
	 * cat_estructuras
	 */
	Route::resource('corevat/CatEstructuras', 'corevat_CatEstructurasController');

	Route::post('corevat/CatEstructuras.{format}', array('as' => 'storeCatEstructuras', 'uses' => 'corevat_CatEstructurasController@store'));

	Route::get('corevat/CatEstructuras.{format}', array('as' => 'indexCatEstructuras', 'uses' => 'corevat_CatEstructurasController@index'));

	Route::put('corevat/CatEstructuras/{id?}.{format}', array('as' => 'updateCatEstructuras', 'uses' => 'corevat_CatEstructurasController@update'));

	Route::get('corevat/CatEstructurasE/{id}', array('as' => 'destroyCatEstructuras', 'uses' => 'corevat_CatEstructurasController@destroy'));

	Route::put('corevat/CatEstructuras/{id?}.{format}', array('as' => 'showCatEstructuras', 'uses' => 'corevat_CatEstructurasController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_factores_conservacion
	 */
	Route::resource('corevat/CatFactoresConservacion', 'corevat_CatFactoresConservacionController');

	Route::post('corevat/CatFactoresConservacion.{format}', array('as' => 'storeCatFactoresConservacion', 'uses' => 'corevat_CatFactoresConservacionController@store'));

	Route::get('corevat/CatFactoresConservacion.{format}', array('as' => 'indexCatFactoresConservacion', 'uses' => 'corevat_CatFactoresConservacionController@index'));

	Route::put('corevat/CatFactoresConservacion/{id?}.{format}', array('as' => 'updateCatFactoresConservacion', 'uses' => 'corevat_CatFactoresConservacionController@update'));

	Route::get('corevat/CatFactoresConservacionE/{id}', array('as' => 'destroyCatFactoresConservacion', 'uses' => 'corevat_CatFactoresConservacionController@destroy'));

	Route::put('corevat/CatFactoresConservacion/{id?}.{format}', array('as' => 'showCatFactoresConservacion', 'uses' => 'corevat_CatFactoresConservacionController@show'));


	/*
	 * CATALOGO DE FACTORES FORMA
	 * cat_factores_forma
	 */
	Route::resource('corevat/CatFactoresForma', 'corevat_CatFactoresFormaController');

	Route::post('corevat/CatFactoresForma.{format}', array('as' => 'storeCatFactoresForma', 'uses' => 'corevat_CatFactoresFormaController@store'));

	Route::get('corevat/CatFactoresForma.{format}', array('as' => 'indexCatFactoresForma', 'uses' => 'corevat_CatFactoresFormaController@index'));

	Route::put('corevat/CatFactoresForma/{id?}.{format}', array('as' => 'updateCatFactoresForma', 'uses' => 'corevat_CatFactoresFormaController@update'));

	Route::get('corevat/CatFactoresFormaE/{id}', array('as' => 'destroyCatFactoresForma', 'uses' => 'corevat_CatFactoresFormaController@destroy'));

	Route::put('corevat/CatFactoresForma/{id?}.{format}', array('as' => 'showCatFactoresForma', 'uses' => 'corevat_CatFactoresFormaController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_factores_frente
	 */
	Route::resource('corevat/CatFactoresFrente', 'corevat_CatFactoresFrenteController');

	Route::post('corevat/CatFactoresFrente.{format}', array('as' => 'storeCatFactoresFrente', 'uses' => 'corevat_CatFactoresFrenteController@store'));

	Route::get('corevat/CatFactoresFrente.{format}', array('as' => 'indexCatFactoresFrente', 'uses' => 'corevat_CatFactoresFrenteController@index'));

	Route::put('corevat/CatFactoresFrente/{id?}.{format}', array('as' => 'updateCatFactoresFrente', 'uses' => 'corevat_CatFactoresFrenteController@update'));

	Route::get('corevat/CatFactoresFrenteE/{id}', array('as' => 'destroyCatFactoresFrente', 'uses' => 'corevat_CatFactoresFrenteController@destroy'));

	Route::put('corevat/CatFactoresFrente/{id?}.{format}', array('as' => 'showCatFactoresFrente', 'uses' => 'corevat_CatFactoresFrenteController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_factores_superficie
	 */
	Route::resource('corevat/CatFactoresSuperficie', 'corevat_CatFactoresSuperficieController');

	Route::post('corevat/CatFactoresSuperficie.{format}', array('as' => 'storeCatFactoresSuperficie', 'uses' => 'corevat_CatFactoresSuperficieController@store'));

	Route::get('corevat/CatFactoresSuperficie.{format}', array('as' => 'indexCatFactoresSuperficie', 'uses' => 'corevat_CatFactoresSuperficieController@index'));

	Route::put('corevat/CatFactoresSuperficie/{id?}.{format}', array('as' => 'updateCatFactoresSuperficie', 'uses' => 'corevat_CatFactoresSuperficieController@update'));

	Route::get('corevat/CatFactoresSuperficieE/{id}', array('as' => 'destroyCatFactoresSuperficie', 'uses' => 'corevat_CatFactoresSuperficieController@destroy'));

	Route::put('corevat/CatFactoresSuperficie/{id?}.{format}', array('as' => 'showCatFactoresSuperficie', 'uses' => 'corevat_CatFactoresSuperficieController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_factores_ubicacion
	 */
	Route::resource('corevat/CatFactoresUbicacion', 'corevat_CatFactoresUbicacionController');

	Route::post('corevat/CatFactoresUbicacion.{format}', array('as' => 'storeCatFactoresUbicacion', 'uses' => 'corevat_CatFactoresUbicacionController@store'));

	Route::get('corevat/CatFactoresUbicacion.{format}', array('as' => 'indexCatFactoresUbicacion', 'uses' => 'corevat_CatFactoresUbicacionController@index'));

	Route::put('corevat/CatFactoresUbicacion/{id?}.{format}', array('as' => 'updateCatFactoresUbicacion', 'uses' => 'corevat_CatFactoresUbicacionController@update'));

	Route::get('corevat/CatFactoresUbicacionE/{id}', array('as' => 'destroyCatFactoresUbicacion', 'uses' => 'corevat_CatFactoresUbicacionController@destroy'));

	Route::put('corevat/CatFactoresUbicacion/{id?}.{format}', array('as' => 'showCatFactoresUbicacion', 'uses' => 'corevat_CatFactoresUbicacionController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_factores_zonas
	 */
	Route::resource('corevat/CatFactoresZonas', 'corevat_CatFactoresZonasController');

	Route::post('corevat/CatFactoresZonas.{format}', array('as' => 'storeCatFactoresZonas', 'uses' => 'corevat_CatFactoresZonasController@store'));

	Route::get('corevat/CatFactoresZonas.{format}', array('as' => 'indexCatFactoresZonas', 'uses' => 'corevat_CatFactoresZonasController@index'));

	Route::put('corevat/CatFactoresZonas/{id?}.{format}', array('as' => 'updateCatFactoresZonas', 'uses' => 'corevat_CatFactoresZonasController@update'));

	Route::get('corevat/CatFactoresZonasE/{id}', array('as' => 'destroyCatFactoresZonas', 'uses' => 'corevat_CatFactoresZonasController@destroy'));

	Route::put('corevat/CatFactoresZonas/{id?}.{format}', array('as' => 'showCatFactoresZonas', 'uses' => 'corevat_CatFactoresZonasController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_muros
	 */
	Route::resource('corevat/CatMuros', 'corevat_CatMurosController');

	Route::post('corevat/CatMuros.{format}', array('as' => 'storeCatMuros', 'uses' => 'corevat_CatMurosController@store'));

	Route::get('corevat/CatMuros.{format}', array('as' => 'indexCatMuros', 'uses' => 'corevat_CatMurosController@index'));

	Route::put('corevat/CatMuros/{id?}.{format}', array('as' => 'updateCatMuros', 'uses' => 'corevat_CatMurosController@update'));

	Route::get('corevat/CatMurosE/{id}', array('as' => 'destroyCatMuros', 'uses' => 'corevat_CatMurosController@destroy'));

	Route::put('corevat/CatMuros/{id?}.{format}', array('as' => 'showCatMuros', 'uses' => 'corevat_CatMurosController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_niveles
	 */
	Route::resource('corevat/CatNiveles', 'corevat_CatNivelesController');

	Route::post('corevat/CatNiveles.{format}', array('as' => 'storeCatNiveles', 'uses' => 'corevat_CatNivelesController@store'));

	Route::get('corevat/CatNiveles.{format}', array('as' => 'indexCatNiveles', 'uses' => 'corevat_CatNivelesController@index'));

	Route::put('corevat/CatNiveles/{id?}.{format}', array('as' => 'updateCatNiveles', 'uses' => 'corevat_CatNivelesController@update'));

	Route::get('corevat/CatNivelesE/{id}', array('as' => 'destroyCatNiveles', 'uses' => 'corevat_CatNivelesController@destroy'));

	Route::put('corevat/CatNiveles/{id?}.{format}', array('as' => 'showCatNiveles', 'uses' => 'corevat_CatNivelesController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_obras_complementarias
	 */
	Route::resource('corevat/CatObrasComplementarias', 'corevat_CatObrasComplementariasController');

	Route::post('corevat/CatObrasComplementarias.{format}', array('as' => 'storeCatObrasComplementarias', 'uses' => 'corevat_CatObrasComplementariasController@store'));

	Route::get('corevat/CatObrasComplementarias.{format}', array('as' => 'indexCatObrasComplementarias', 'uses' => 'corevat_CatObrasComplementariasController@index'));

	Route::put('corevat/CatObrasComplementarias/{id?}.{format}', array('as' => 'updateCatObrasComplementarias', 'uses' => 'corevat_CatObrasComplementariasController@update'));

	Route::get('corevat/CatObrasComplementariasE/{id}', array('as' => 'destroyCatObrasComplementarias', 'uses' => 'corevat_CatObrasComplementariasController@destroy'));

	Route::put('corevat/CatObrasComplementarias/{id?}.{format}', array('as' => 'showCatObrasComplementarias', 'uses' => 'corevat_CatObrasComplementariasController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_orientaciones
	 */
	Route::resource('corevat/CatOrientaciones', 'corevat_CatOrientacionesController');

	Route::post('corevat/CatOrientaciones.{format}', array('as' => 'storeCatOrientaciones', 'uses' => 'corevat_CatOrientacionesController@store'));

	Route::get('corevat/CatOrientaciones.{format}', array('as' => 'indexCatOrientaciones', 'uses' => 'corevat_CatOrientacionesController@index'));

	Route::put('corevat/CatOrientaciones/{id?}.{format}', array('as' => 'updateCatOrientaciones', 'uses' => 'corevat_CatOrientacionesController@update'));

	Route::get('corevat/CatOrientacionesE/{id}', array('as' => 'destroyCatOrientaciones', 'uses' => 'corevat_CatOrientacionesController@destroy'));

	Route::put('corevat/CatOrientaciones/{id?}.{format}', array('as' => 'showCatOrientaciones', 'uses' => 'corevat_CatOrientacionesController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_pisos
	 */
	Route::resource('corevat/CatPisos', 'corevat_CatPisosController');

	Route::post('corevat/CatPisos.{format}', array('as' => 'storeCatPisos', 'uses' => 'corevat_CatPisosController@store'));

	Route::get('corevat/CatPisos.{format}', array('as' => 'indexCatPisos', 'uses' => 'corevat_CatPisosController@index'));

	Route::put('corevat/CatPisos/{id?}.{format}', array('as' => 'updateCatPisos', 'uses' => 'corevat_CatPisosController@update'));

	Route::get('corevat/CatPisosE/{id}', array('as' => 'destroyCatPisos', 'uses' => 'corevat_CatPisosController@destroy'));

	Route::put('corevat/CatPisos/{id?}.{format}', array('as' => 'showCatPisos', 'uses' => 'corevat_CatPisosController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_plafones
	 */
	Route::resource('corevat/CatPlafones', 'corevat_CatPlafonesController');

	Route::post('corevat/CatPlafones.{format}', array('as' => 'storeCatPlafones', 'uses' => 'corevat_CatPlafonesController@store'));

	Route::get('corevat/CatPlafones.{format}', array('as' => 'indexCatPlafones', 'uses' => 'corevat_CatPlafonesController@index'));

	Route::put('corevat/CatPlafones/{id?}.{format}', array('as' => 'updateCatPlafones', 'uses' => 'corevat_CatPlafonesController@update'));

	Route::get('corevat/CatPlafonesE/{id}', array('as' => 'destroyCatPlafones', 'uses' => 'corevat_CatPlafonesController@destroy'));

	Route::put('corevat/CatPlafones/{id?}.{format}', array('as' => 'showCatPlafones', 'uses' => 'corevat_CatPlafonesController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_proximidad_urbana
	 */
	Route::resource('corevat/CatProximidadUrbana', 'corevat_CatProximidadUrbanaController');

	Route::post('corevat/CatProximidadUrbana.{format}', array('as' => 'storeCatProximidadUrbana', 'uses' => 'corevat_CatProximidadUrbanaController@store'));

	Route::get('corevat/CatProximidadUrbana.{format}', array('as' => 'indexCatProximidadUrbana', 'uses' => 'corevat_CatProximidadUrbanaController@index'));

	Route::put('corevat/CatProximidadUrbana/{id?}.{format}', array('as' => 'updateCatProximidadUrbana', 'uses' => 'corevat_CatProximidadUrbanaController@update'));

	Route::get('corevat/CatProximidadUrbanaE/{id}', array('as' => 'destroyCatProximidadUrbana', 'uses' => 'corevat_CatProximidadUrbanaController@destroy'));

	Route::put('corevat/CatProximidadUrbana/{id?}.{format}', array('as' => 'showCatProximidadUrbana', 'uses' => 'corevat_CatProximidadUrbanaController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_regimen_propiedad
	 */
	Route::resource('corevat/CatRegimenPropiedad', 'corevat_CatRegimenPropiedadController');

	Route::post('corevat/CatRegimenPropiedad.{format}', array('as' => 'storeCatProximidadUrbana', 'uses' => 'corevat_CatProximidadUrbanaController@store'));

	Route::get('corevat/CatRegimenPropiedad.{format}', array('as' => 'indexCatRegimenPropiedad', 'uses' => 'corevat_CatRegimenPropiedadController@index'));

	Route::put('corevat/CatRegimenPropiedad/{id?}.{format}', array('as' => 'updateCatRegimenPropiedad', 'uses' => 'corevat_CatRegimenPropiedadController@update'));

	Route::get('corevat/CatRegimenPropiedadE/{id}', array('as' => 'destroyCatRegimenPropiedad', 'uses' => 'corevat_CatRegimenPropiedadController@destroy'));

	Route::put('corevat/CatRegimenPropiedad/{id?}.{format}', array('as' => 'showCatRegimenPropiedad', 'uses' => 'corevat_CatRegimenPropiedadController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_techos
	 */
	Route::resource('corevat/CatTechos', 'corevat_CatTechosController');

	Route::post('corevat/CatTechos.{format}', array('as' => 'storeCatTechos', 'uses' => 'corevat_CatTechosController@store'));

	Route::get('corevat/CatTechos.{format}', array('as' => 'indexCatTechos', 'uses' => 'corevat_CatTechosController@index'));

	Route::put('corevat/CatTechos/{id?}.{format}', array('as' => 'updateCatTechos', 'uses' => 'corevat_CatTechosController@update'));

	Route::get('corevat/CatTechosE/{id}', array('as' => 'destroyCatTechos', 'uses' => 'corevat_CatTechosController@destroy'));

	Route::put('corevat/CatTechos/{id?}.{format}', array('as' => 'showCatTechos', 'uses' => 'corevat_CatTechosController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_tipo
	 */
	Route::resource('corevat/CatTipo', 'corevat_CatTipoController');

	Route::post('corevat/CatTipo.{format}', array('as' => 'storeCatTipo', 'uses' => 'corevat_CatTipoController@store'));

	Route::get('corevat/CatTipo.{format}', array('as' => 'indexCatTipo', 'uses' => 'corevat_CatTipoController@index'));

	Route::put('corevat/CatTipo/{id?}.{format}', array('as' => 'updateCatTipo', 'uses' => 'corevat_CatTipoController@update'));

	Route::get('corevat/CatTipoE/{id}', array('as' => 'destroyCatTipo', 'uses' => 'corevat_CatTipoController@destroy'));

	Route::put('corevat/CatTipo/{id?}.{format}', array('as' => 'showCatTipo', 'uses' => 'corevat_CatTipoController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_tipo_inmueble
	 */
	Route::resource('corevat/CatTipoInmueble', 'corevat_CatTipoInmuebleController');

	Route::post('corevat/CatTipoInmueble.{format}', array('as' => 'storeCatTipoInmueble', 'uses' => 'corevat_CatTipoInmuebleController@store'));

	Route::get('corevat/CatTipoInmueble.{format}', array('as' => 'indexCatTipoInmueble', 'uses' => 'corevat_CatTipoInmuebleController@index'));

	Route::put('corevat/CatTipoInmueble/{id?}.{format}', array('as' => 'updateCatTipoInmueble', 'uses' => 'corevat_CatTipoInmuebleController@update'));

	Route::get('corevat/CatTipoInmuebleE/{id}', array('as' => 'destroyCatTipoInmueble', 'uses' => 'corevat_CatTipoInmuebleController@destroy'));

	Route::put('corevat/CatTipoInmueble/{id?}.{format}', array('as' => 'showCatTipoInmueble', 'uses' => 'corevat_CatTipoInmuebleController@show'));


	/*
	 * CATALOGO DE ENTREPISOS
	 * cat_usos_suelos
	 */
	Route::resource('corevat/CatUsosSuelos', 'corevat_CatUsosSuelosController');

	Route::post('corevat/CatUsosSuelos.{format}', array('as' => 'storeCatUsosSuelos', 'uses' => 'corevat_CatUsosSuelosController@store'));

	Route::get('corevat/CatUsosSuelos.{format}', array('as' => 'indexCatUsosSuelos', 'uses' => 'corevat_CatUsosSuelosController@index'));

	Route::put('corevat/CatUsosSuelos/{id?}.{format}', array('as' => 'updateCatUsosSuelos', 'uses' => 'corevat_CatUsosSuelosController@update'));

	Route::get('corevat/CatUsosSuelosE/{id}', array('as' => 'destroyCatUsosSuelos', 'uses' => 'corevat_CatUsosSuelosController@destroy'));

	Route::put('corevat/CatUsosSuelos/{id?}.{format}', array('as' => 'showCatUsosSuelos', 'uses' => 'corevat_CatUsosSuelosController@show'));




















	/*
	 * FOLIOS
	 * folios
	 */
	Route::resource('corevat/Folios', 'corevat_FoliosController');

	Route::get('corevat/Folios.{format}', array('as' => 'indexFolios', 'uses' => 'corevat_FoliosController@index'));

	Route::put('corevat/Folios/{id?}.{format}', array('as' => 'showFolios', 'uses' => 'corevat_FoliosController@show'));

	Route::post('corevat/Folios.{format}', array('as' => 'storeFolios', 'uses' => 'corevat_FoliosController@store'));

	Route::put('corevat/Folios/{id?}.{format}', array('as' => 'updateFolios', 'uses' => 'corevat_FoliosController@update'));

	Route::get('corevat/FoliosE/{id}', array('as' => 'destroyFolios', 'uses' => 'corevat_FoliosController@destroy'));


	/*
	 * FOLIOS DETALLE
	 * folios_detalles
	 */
	Route::resource('corevat/FoliosDetalle', 'corevat_FoliosDetalleController');

	Route::get('corevat/FoliosDetalle/{id?}.{format}', array('as' => 'indexFoliosDetalle', 'uses' => 'corevat_FoliosDetalleController@index'));

	Route::put('corevat/FoliosDetalle/{id?}.{format}', array('as' => 'showFoliosDetalle', 'uses' => 'corevat_FoliosDetalleController@show'));

	Route::post('corevat/FoliosDetalle.{format}', array('as' => 'storeFoliosDetalle', 'uses' => 'corevat_FoliosDetalleController@store'));

	Route::put('corevat/FoliosDetalle/{id?}.{format}', array('as' => 'updateFoliosDetalle', 'uses' => 'corevat_FoliosDetalleController@update'));

	Route::get('corevat/FoliosDetalleE/{id}', array('as' => 'destroyFoliosDetalle', 'uses' => 'corevat_FoliosDetalleController@destroy'));


	/*
	 * 
	 * FOLIOS DETALLE
	 * folios_detalles_singles
	 * 
	 */
	Route::resource('corevat/FoliosDetallesSingles', 'corevat_FoliosDetallesSinglesController');

	Route::get('corevat/FoliosDetallesSingles/{id?}.{format}', array('as' => 'indexFoliosDetallesSingles', 'uses' => 'corevat_FoliosDetallesSinglesController@index'));

	Route::put('corevat/FoliosDetallesSingles/{id?}.{format}', array('as' => 'showFoliosDetallesSingles', 'uses' => 'corevat_FoliosDetallesSinglesController@show'));

	Route::post('corevat/FoliosDetallesSingles.{format}', array('as' => 'storeFoliosDetalle', 'uses' => 'corevat_FoliosDetallesSinglesController@store'));

	Route::put('corevat/FoliosDetallesSingles/{id?}.{format}', array('as' => 'updateFoliosDetallesSingles', 'uses' => 'corevat_FoliosDetallesSinglesController@update'));

	Route::get('corevat/FoliosDetallesSinglesE/{id}', array('as' => 'destroyFoliosDetallesSingles', 'uses' => 'corevat_FoliosDetallesSinglesController@destroy'));


	/*
	 * 
	 * AVALUOS
	 * avaluos
	 * 
	 */
	Route::resource('corevat/Avaluos', 'corevat_AvaluosController');

	Route::get('corevat/Avaluos/{id?}.{format}', array('as' => 'indexAvaluos', 'uses' => 'corevat_AvaluosController@index'));

	Route::put('corevat/Avaluos/{id?}.{format}', array('as' => 'showAvaluos', 'uses' => 'corevat_AvaluosController@show'));

	Route::post('corevat/Avaluos.{format}', array('as' => 'storeAvaluos', 'uses' => 'corevat_AvaluosController@store'));

	Route::put('corevat/Avaluos/{id?}.{format}', array('as' => 'updateAvaluos', 'uses' => 'corevat_AvaluosController@update'));

	Route::get('corevat/AvaluosE/{id}', array('as' => 'destroyAvaluos', 'uses' => 'corevat_AvaluosController@destroy'));


	/*
	 * 
	 * AVALUO CONCLUSIONES
	 * avaluo_conclusiones
	 * 
	 */
	Route::resource('corevat/AvaluoConclusiones', 'corevat_AvaluoConclusionesController');

	Route::get('corevat/AvaluoConclusiones/{id?}.{format}', array('as' => 'indexAvaluoConclusiones', 'uses' => 'corevat_AvaluoConclusionesController@index'));

	Route::put('corevat/AvaluoConclusiones/{id?}.{format}', array('as' => 'showAvaluoConclusiones', 'uses' => 'corevat_AvaluoConclusionesController@show'));

	Route::post('corevat/AvaluoConclusiones.{format}', array('as' => 'storeAvaluoConclusiones', 'uses' => 'corevat_AvaluoConclusionesController@store'));

	Route::put('corevat/AvaluoConclusiones/{id?}.{format}', array('as' => 'updateAvaluoConclusiones', 'uses' => 'corevat_AvaluoConclusionesController@update'));

	Route::get('corevat/AvaluoConclusionesE/{id}', array('as' => 'destroyAvaluoConclusiones', 'uses' => 'corevat_AvaluoConclusionesController@destroy'));



	/*
	 * 
	 * AVALUO ENFOQUE FISICO
	 * avaluo_enfoque_fisico
	 * 
	 */
	Route::resource('corevat/AvaluoEnfoqueFisicoConclusiones', 'corevat_AvaluoEnfoqueFisicoConclusionesController');

	Route::get('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'indexAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@index'));

	Route::put('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'showAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@show'));

	Route::post('corevat/AvaluoEnfoqueFisico.{format}', array('as' => 'storeAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@store'));

	Route::put('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'updateAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@update'));

	Route::get('corevat/AvaluoEnfoqueFisicoE/{id}', array('as' => 'destroyAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@destroy'));



	/*
	 * 
	 * Enfoque Físico del Avaluo Comp Construcción
	 * aef_comp_construcciones
	 * 
	 */
	Route::resource('corevat/PatoConclusiones', 'corevat_AvaluoEnfoqueFisicoConclusionesController');

	Route::get('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'indexAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@index'));

	Route::put('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'showAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@show'));

	Route::post('corevat/AvaluoEnfoqueFisico.{format}', array('as' => 'storeAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@store'));

	Route::put('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'updateAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@update'));

	Route::get('corevat/AvaluoEnfoqueFisicoE/{id}', array('as' => 'destroyAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@destroy'));



	/*
	 * 
	 * PATO
	 * pato
	 * 
	 */
	Route::resource('corevat/PatoConclusiones', 'corevat_AvaluoEnfoqueFisicoConclusionesController');

	Route::get('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'indexAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@index'));

	Route::put('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'showAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@show'));

	Route::post('corevat/AvaluoEnfoqueFisico.{format}', array('as' => 'storeAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@store'));

	Route::put('corevat/AvaluoEnfoqueFisico/{id?}.{format}', array('as' => 'updateAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@update'));

	Route::get('corevat/AvaluoEnfoqueFisicoE/{id}', array('as' => 'destroyAvaluoEnfoqueFisico', 'uses' => 'corevat_AvaluoEnfoqueFisicoController@destroy'));

});
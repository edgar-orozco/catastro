<?php

Route::group(['before' => 'auth'], function() {

    //instalaciones especiales
    Route::get("complementarios/{id?}", "complementarios_ComplementariosController@index");
    Route::get("cargar-complementos/{id?}", "complementarios_ComplementariosController@getPredio");
    Route::get("cargar-complementos/{id?}", "complementarios_ComplementariosController@getInstalacion");
    Route::get("cargar-complementos-editar/{id?}", "complementarios_ComplementariosController@getCargar");
    Route::post("cargar-complementos-editar/{id?}", "complementarios_ComplementariosController@getEditar");
    Route::get("cargar-complementose/{id?}", "complementarios_ComplementariosController@getEliminar");
    Route::get("agregar/{id?}", "complementarios_ComplementariosController@getAgregar");
    Route::post("agregar/{id?}", "complementarios_ComplementariosController@post_agregar");
    //construcciones
    Route::get("cargar-complementos/{id?}", "complementarios_ComplementariosController@getConstruccion");
    Route::get('/complementos-editar/{id?}', "complementarios_ComplementariosController@getCargarconstruccion");
    Route::post('/complementos-editar/{id?}', "complementarios_ComplementariosController@getEditarConstruccionConstruccion");
    Route::get('/cargar-complementos-eliminar/{id?}', "complementarios_ComplementariosController@getEliminarConstruccion");
    Route::get('/agregar-construccion/{id?}', "complementarios_ComplementariosController@getAgregarConstruccion");
    Route::post('/agregar-construccion/{id?}', "complementarios_ComplementariosController@post_AgregarAgregarConstruccion");
    //techos
    Route::get('/cargar-complementos/agregar-techos/{id?}', "complementarios_ComplementariosController@getAgregarTechos");
    Route::post('/cargar-complementos/agregar-techos/{id?}', "complementarios_ComplementariosController@postAgregarTechos");
    Route::get('/cargar-complementos/eliminar-techos/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarTechos");
    //muros
    Route::get('/cargar-complementos/agregar-muros/{id?}', "complementarios_ComplementariosController@getAgregarMuros");
    Route::post('/cargar-complementos/agregar-muros/{id?}', "complementarios_ComplementariosController@postAgregarMuros");
    Route::get('/cargar-complementos/eliminar-muros/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarMuros");
    //clase construccion
    Route::get('/cargar-complementos/agregar-clase-construccion/{id?}', "complementarios_ComplementariosController@getAgregarClaseConstruccion");
    Route::post('/cargar-complementos/agregar-clase-construccion/{id?}', "complementarios_ComplementariosController@postAgregarClaseConstruccion");
    Route::get('/cargar-complementos/eliminar-clase-construccion/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarClases");
    //ventanas
    Route::get('/cargar-complementos/agregar-ventanas/{id?}', "complementarios_ComplementariosController@getAgregarVentanas");
    Route::post('/cargar-complementos/agregar-ventanas/{id?}', "complementarios_ComplementariosController@postAgregarVentanas");
    Route::get('/cargar-complementos/eliminar-ventanas/{id?}/{gid?}', "complementarios_ComplementariosController@getEliminarVentanas");
    //condominios
    Route::get('/cargar-complementos/{id?}', "complementarios_ComplementariosController@getInstalacion");
    Route::get('/agregar-condominio/{id?}', "complementarios_ComplementariosController@getAgregarCondominio");
    Route::post('/agregar-condominio/{id?}', "complementarios_ComplementariosController@post_addcondominio");
    Route::get('/cargar-condominio-destroy/{id?}', 'complementarios_ComplementariosController@getEliminarCondominio');
    Route::get('/cargar-condominio-editar/{id?}', 'complementarios_ComplementariosController@getEditarCondominio');
    Route::post('/cargar-condominio-editar/{id?}', 'complementarios_ComplementariosController@getCondominio');
    //servicio
    Route::get('/agregar-servicios/{id?}', 'complementarios_ComplementariosController@get_servicios');
    Route::post('/cargar-servicios/{id?}', 'complementarios_ComplementariosController@post_agregarservicio');

    //Giros
    Route::get('/cargar-complementos/agregar-giros/{id?}', 'complementarios_ComplementariosController@get_giros');
});

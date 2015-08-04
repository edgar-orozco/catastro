<?php
//ruta inicio macro notaria
Route::get('/ofvirtual/notario/registro-escrituras','ofvirtual_RegistroEscrituraController@getIndex');

Route::get('ofvirtual/notario/registro/create', 'ofvirtual_RegistroEscrituraController@create');
Route::post('ofvirtual/notario/registro/create', 'ofvirtual_RegistroEscrituraController@store');

//Búsqueda de trámites
Route::post('ofvirtual/notario/registro/buscar','ofvirtual_RegistroEscrituraController@buscar');

Route::get('/ofvirtual/notario/registro','ofvirtual_RegistroEscrituraController@create');

//buscador
//Búsqueda de trámites
Route::post('ofvirtual/notario/registro/buscar','ofvirtual_RegistroEscrituraController@buscar');

//auto completar para la curp
Route::get('/registro/autocomplete', 'ofvirtual_RegistroEscrituraController@autocomplete');

//show
Route::get('ofvirtual/notario/registro/show/{id}', 'ofvirtual_RegistroEscrituraController@show');

//show
Route::get('ofvirtual/notario/registro/asignarFolio/{id}', 'ofvirtual_RegistroEscrituraController@asignarFolio');

//Delete traslado de dominio
Route::get('ofvirtual/notario/registro/destroy/{id}', 'ofvirtual_RegistroEscrituraController@destroy');

//imprimir
Route::get('ofvirtual/notario/registro/imprimir/{id}', 'ofvirtual_RegistroEscrituraController@imprimir');

//edit
Route::get('ofvirtual/notario/registro/edit/{id}', 'ofvirtual_RegistroEscrituraController@edit');

//update
Route::get('ofvirtual/notario/registro/update/{id}', 'ofvirtual_RegistroEscrituraController@update');

Route::get('ofvirtual/notario/registro/enajenante', 'ofvirtual_RegistroEscrituraController@getEnajenante');
Route::get('ofvirtual/notario/registro/adquiriente', 'ofvirtual_RegistroEscrituraController@getAdquiriente');


/*function()
          {
            $title = "Registro de escrituras";
            return View::make('ofvirtual.notario.registro.index', compact('title'));
          });*/
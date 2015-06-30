<?php

//
Route::get('ofvirtual/notario/traslado', 'OficinaVirtualNotarioController@index');

//edit
Route::get('ofvirtual/notario/traslado/edit/{id}', 'OficinaVirtualNotarioController@edit');

//Delete traslado de dominio
Route::get('ofvirtual/notario/traslado/destroy/{id}', 'OficinaVirtualNotarioController@destroy');

//Alta traslado de dominio
Route::get('ofvirtual/notario/traslado/create', 'OficinaVirtualNotarioController@create');
Route::post('ofvirtual/notario/traslado/create', 'OficinaVirtualNotarioController@store');

//update
Route::get('ofvirtual/notario/traslado/update/{id}', 'OficinaVirtualNotarioController@update');

//destroy
Route::get('ofvirtual/notario/traslado/destroy/{id}', 'OficinaVirtualNotarioController@destroy');

//show
Route::get('ofvirtual/notario/traslado/show/{id}', 'OficinaVirtualNotarioController@show');

//show
Route::get('ofvirtual/notario/traslado/asignarFolio/{id}', 'OficinaVirtualNotarioController@asignarFolio');


//buscador
//Búsqueda de trámites
Route::post('ofvirtual/notario/traslado/buscar','OficinaVirtualNotarioController@buscar');

//rutas de las macros para registro de escituras
 Route::get('/macro', function()
          {
            $title = "Captura de personas";
            return View::make('macros.personasMacros', compact('tipo', 'title'));
          });
//ruta guardar personas pre-registro
Route::post("/macro-guardar", "ofvirtual_RegistroEscrituraController@create");

//ruta inicio macro notaria
Route::get('/oficinav-notaria', function()
          {
            $title = "Captura de personas";
            return View::make('macros.notaria.notaria', compact('tipo', 'title'));
          });
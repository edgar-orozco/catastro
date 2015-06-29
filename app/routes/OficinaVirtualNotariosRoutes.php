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

 Route::get('/macro', function()
          {
            $title = "Captura de personas";
        //echo "hola mundo de macros, valor recibido: ".$tipo;
        return View::make('macros.personasMacros', compact('tipo', 'title'));
          //  return View::make('macros.personasMac');
          });
         //ruta formato pre-registro escrituras
        // Route::get("/macro-formato", "macros_macrosController@create");

         //ruta guardar personas pre-registro
         Route::post("/macro-guardar", "ofvirtual_RegistroEscrituraController@create");
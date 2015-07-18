<?php
//ruta inicio macro notaria
Route::get('/ofvirtual/notario/registro-escrituras','ofvirtual_RegistroEscrituraController@getIndex');

Route::get('ofvirtual/notario/registro/create', 'ofvirtual_RegistroEscrituraController@create');
Route::post('ofvirtual/notario/registro/create', 'ofvirtual_RegistroEscrituraController@store');

//Búsqueda de trámites
Route::post('ofvirtual/notario/registro/buscar','ofvirtual_RegistroEscrituraController@buscar');

Route::get('/ofvirtual/notario/registro','ofvirtual_RegistroEscrituraController@create');

/*function()
          {
            $title = "Registro de escrituras";
            return View::make('ofvirtual.notario.registro.index', compact('title'));
          });*/
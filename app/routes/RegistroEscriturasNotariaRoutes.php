<?php
//ruta inicio macro notaria
Route::get('/ofvirtual/notario/registro-escrituras', function()
          {
            $title = "Registro de escrituras";
            return View::make('ofvirtual.notario.registro.index', compact('title'));
          });
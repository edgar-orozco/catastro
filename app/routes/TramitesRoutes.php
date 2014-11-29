<?php

//Rutas para el administrador de catálogo de requisitos para trámites
Route::resource('admin/requisitos', 'RequisitosController');

//Rutas para el administrador de catálogod de trámites
Route::resource('admin/tipotramites', 'TipotramitesController');
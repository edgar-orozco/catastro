<?php

Route::get("admin/registro/carga", "RegistroPublico_RegistroPublicoController@index");
Route::post("admin/registro/carga", "RegistroPublico_RegistroPublicoController@upload");
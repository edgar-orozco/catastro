<?php

//Index
Route::get('kiosko/consulta-boleta-predial',
  'ConsultaBoletaPredialController@index');

Route::post('kiosko/consulta-boleta-predial',
  'ConsultaBoletaPredialController@consulta');


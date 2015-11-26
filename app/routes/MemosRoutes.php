<?php

Route::get('reportes/memos.{format}',
        array('as'=>'IndexMemos', 'uses' => 'memos_MemosController@index'));
Route::resource('reportes/memos', 'memos_MemosController');

//Ruta para el recibo en pdf
Route::get("memos/recibo", "memos_MemosController@get_pdf");
<?php

Route::get('reportes/memos.{format}',
        array('as'=>'IndexMemos', 'uses' => 'memos_MemosController@index'));
Route::resource('reportes/memos', 'memos_MemosController');

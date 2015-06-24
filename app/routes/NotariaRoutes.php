<?php
Route::group(array('before'=>'admin'), function (){
 //Rutas para el catalogo de Notaria
    Route::get('admin/notaria.{format}',
        array('as' => 'indexNotaria', 'uses' => 'admin_notariaController@index'));
    Route::post('admin/notaria.{format}',
        array('as'=>'storeNotaria','uses'=>'admin_notariaController@store'));
    Route::put('admin/notaria/{id?}.{format}',
        array('as' => 'updateNotaria', 'uses' => 'admin_notariaController@update'));
    Route::get('admin/notariaE/{id}',
        array('as' => 'destroyNotaria', 'uses' => 'admin_notariaController@destroy'));
    Route::resource('admin/notaria', 'admin_notariaController');
});
        




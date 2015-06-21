<?php
Route::group(array('before'=>'admin'), function (){
 //Rutas para el catalogo de Notaria
    Route::get('ventanilla/notaria.{format}',
        array('as' => 'indexNotaria', 'uses' => 'admin_notariaController@index'));
    Route::post('ventanilla/notaria.{format}',
        array('as'=>'storeNotaria','uses'=>'admin_notariaController@store'));
    Route::put('ventanilla/notaria/{id?}.{format}',
        array('as' => 'updateNotaria', 'uses' => 'admin_notariaController@update'));
    Route::get('ventanilla/notariaE/{id}',
        array('as' => 'destroyNotaria', 'uses' => 'admin_notariaController@destroy'));
    Route::resource('ventanilla/notaria', 'admin_notariaController');
});
        




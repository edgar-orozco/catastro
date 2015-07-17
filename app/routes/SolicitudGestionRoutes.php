<?php
Route::group(array('before'=>'Kiosko'),  function (){
//Rutas para la primera solicitud de kiosko
Route::post('kiosko/store',
        array('as'=>'storeKiosko','uses'=>'kiosko_SolicitudGestionController@store'));
Route::get('kiosko/solicitud.{format}',
        array('as'=>'indexKiosko','uses'=>'kiosko_SolicitudGestionController@index'));
//para el formato en pdf
Route::get("kiosko/solicitud_pdf/{id}",array('as'=>'pdfKiosko', 'uses'=>"kiosko_SolicitudGestionController@solicitudIndex"));
Route::resource('kiosko/solicitud','kiosko_SolicitudGestionController');

//editar
Route::get('/kiosko/solicitud/edit/{id}', 'kiosko_SolicitudGestionController@edit');

Route::put('kiosko/solicitud/{id?}',
        array('as' => 'updateSolicitud', 'uses' => 'kiosko_SolicitudGestionController@update'));
});

Route::filter('Kiosko', function () {

    if (! ( Entrust::hasRole('Kiosko') ||  Entrust::hasRole('Super usuario') ) )
    {
        return Redirect::to('/');
    }
});
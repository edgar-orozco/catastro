<?php
Form::macro('domicilio', function($llave,$vialidad,$entidad,$asentamiento,$municipio)
{
$domicilio = '
            <div class="row-fluid">
                <div class="col-md-6">'.
            Form::label($llave.'[tipo_vialidad_id]','Tipo de vialidad', ['class'=>'']).
            Form::select($llave.'[tipo_vialidad_id]',$vialidad, null ,['class' => 'form-control focus']).
            Form::hidden($llave.'[id]', null, ['id' =>$llave.'[id]', 'class' => 'form-control'] ).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[vialidad]','Vialidad', ['class'=>'']).
            Form::text($llave.'[vialidad]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[num_ext]','Número Externo', ['class'=>'']).
            Form::text($llave.'[num_ext]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[num_int]','Número Interno', ['class'=>'']).
            Form::text($llave.'[num_int]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[tipo_asentamiento_id]','Tipo de asentamiento', ['class'=>'']).
            Form::select($llave.'[tipo_asentamiento_id]', $asentamiento, null, ['class' => 'form-control focus']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[asentamiento]','Asentamiento', ['class'=>'']).
            Form::text($llave.'[asentamiento]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[cp]','Código Postal', ['class'=>'']).
            Form::text($llave.'[cp]', null, ['class' => 'form-control '.$llave.'-codgio','maxlength'=>'5','title' => 'El Código Postal ingresado no tiene el formato esperado, verifique nuevamente el Código Postal ingresado']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[localidad]','Localidad', ['class'=>'']).
            Form::text($llave.'[localidad]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[municipio]','Municipio', ['class'=>'']).
            Form::select($llave.'[municipio]', $municipio, null, ['class' => 'form-control focus']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[entidad]','Entidad', ['class'=>'']).
            Form::select($llave.'[entidad]', $entidad, 27, ['class' => 'form-control focus']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[referencia]','Referencia', ['class'=>'']).
            Form::text($llave.'[referencia]', null, ['class' => 'form-control']).
            '</div></div>' ;
    return $domicilio;
});
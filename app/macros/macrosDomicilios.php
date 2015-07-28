<?php
Form::macro('domicilio', function($llave,$vialidad,$entidad,$asentamiento,$municipio)
{
$domicilio = '
            <div class="row-fluid">
                <div class="col-md-6">'.
            Form::label($llave.'[tipo_vialidad_id]','Tipo de vialidad', ['class'=>'']).
            Form::select($llave.'[tipo_vialidad_id]',$vialidad, null ,['class' => 'form-control focus']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[vialidad]','Vialidad', ['class'=>'']).
            Form::text($llave.'[vialidad]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[num_ext]','Numero Externo', ['class'=>'']).
            Form::text($llave.'[num_ext]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[num_int]','Numero Interno', ['class'=>'']).
            Form::text($llave.'[num_int]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[tipo_asentamiento_id]','Tipo de asentamientoasentamiento', ['class'=>'']).
            Form::select($llave.'[tipo_asentamiento_id]', $asentamiento, null, ['class' => 'form-control focus']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[asentamiento]','Asentamiento', ['class'=>'']).
            Form::text($llave.'[asentamiento]', null, ['class' => 'form-control']).
            '</div>'.
            '<div class="col-md-6">'.
            Form::label($llave.'[cp]','Codigo Postal', ['class'=>'']).
            Form::text($llave.'[cp]', null, ['class' => 'form-control']).
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
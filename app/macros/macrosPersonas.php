<?php
Form::macro('personas', function($llave)
{
     $personas = HTML::script('js/macros.js').
     '<div class="row">
    <div class="col-md-6">'.
             Form::text($llave.'[id_tipo]',1,['id' => 'id_tipo','hidden']).
           
             Form::label($llave.'[nombres]','Nombre',['id' => 'nombre']).
             Form::text($llave.'[nombres]', null, ['class' => 'form-control'] ).
    '</div>'.
    ' <div class="col-md-6">'.
             Form::label($llave.'[apellido_paterno]','Apellido paterno',['id' => 'apellido_paterno']).
             Form::text($llave.'[apellido_paterno]', null, ['class' => 'form-control'] ).
    '</div>'.
    ' <div class="col-md-6">'.
             Form::label($llave.'[apellido_materno]','Apellido materno',['id' => 'apellido_materno']).
             Form::text($llave.'[apellido_materno]', null, ['class' => 'form-control'] ).
    '</div>'.
    ' <div class="col-md-6">'.
             Form::label($llave.'[curp]','CURP', ['class'=>'','id' => 'curp']).
             Form::text($llave.'[curp]', null, ['class' => 'form-control','required',
                    'minlength'=>'18',
                    'maxlength'=>'18',
                    'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})',
                    'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado',

              ]).
    '</div>'.
    ' <div class="col-md-6">'.
               Form::label($llave.'[rfc]','R.F.C', ['class'=>'']).
             Form::text($llave.'[rfc]', null, ['class' => 'form-control','required',
                    'minlength'=>'13',
                    'maxlength'=>'13',
                    'pattern' => '([a-zA-Z]{4})([0-9]{6})([a-zA-Z]{2})([0-9]{1})',
                    'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'
              ]).
    '</div>'.
    '</div>'
             ;

    return $personas;
});
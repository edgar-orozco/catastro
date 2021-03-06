<?php
Form::macro('personas', function($llave)
{
$personas = '
            <div class="">'.
                Form::label('tipo_persona','Tipo de persona', ['class'=>'']).
                '<br>'.
                Form::label('tipo_persona','Física', ['class'=>'']).
                Form::radio($llave.'[id_tipo]', '1', null, ['class'=>$llave.'-radio-persona', 'data-tipo' => $llave,'id' => $llave.'Fisica' ]).
                Form::label('tipo_persona','Moral', ['class'=>'']).
                Form::radio($llave.'[id_tipo]', '2', null, ['class'=>$llave.'-radio-persona','data-tipo' => $llave,'id' => $llave.'Moral']).
            '</div>'.
                Form::label($llave.'[curp]','CURP', ['class'=>$llave]).
                Form::text($llave.'[curp]', null, ['class' => 'form-control curp '.$llave, 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado']).
                Form::hidden($llave.'[id_p]', null, ['id' =>$llave.'[id_p]', 'class' => 'form-control'] ).
                Form::label($llave.'[rfc]','RFC', ['class'=>'']).
                Form::text($llave.'[rfc]', null, ['class' => 'form-control', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] ).
                Form::label($llave.'[nombres]','Nombre', ['class'=>'']).
                Form::text($llave.'[nombres]', null, ['class' => 'form-control', 'required'=>true] ).
            '<span class='.$llave.'>'.
                Form::label($llave.'[apellido_paterno]','Apellido Paterno', ['class'=>'']).
                Form::text($llave.'[apellido_paterno]', null, ['class' => 'form-control'] ).
                Form::label($llave.'[apellido_materno]','Apellido Materno', ['class'=>'']).
                Form::text($llave.'[apellido_materno]', null, ['class' => 'form-control'] ).
        '</span>' ;
    return $personas;
});
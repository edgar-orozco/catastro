<?php
Form::macro('copropietario', function($llave)
{
$personas = '
            <br><div class="row">' .
            Form::button('<i class="glyphicon glyphicon-plus"></i> Agregar Persona Fisica', ['class' => 'btn btn-success agregarPersonaFisica', 'type' => 'button']) .
            '<br>'.
            Form::button('<i class="glyphicon glyphicon-plus"></i> Agregar Persona Moral', ['class' => 'btn btn-success agregarPersonaMoral', 'type' => 'button']) .
            '<h6>Primero Crear la cantidad total de campos, luego Proceder a capturar los datos.</h6>'.
        '</div><br>'.


         '<div id="personaDiv">'.
 '<div class="form-inline" id="personaDiv1">'.
 '<fieldset>'.

                Form::label($llave.'[1][curp]','CURP', ['class'=>$llave]).
                Form::text($llave.'[1][curp]', null, ['class' => 'form-control curp '.$llave, 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado']).
                Form::label($llave.'[1][rfc]','RFC', ['class'=>'']).
                Form::text($llave.'[1][rfc]', null, ['class' => 'form-control rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] ).
                Form::label($llave.'[1][nombres]','Nombre', ['class'=>'']).
                Form::text($llave.'[1][nombres]', null, ['class' => 'form-control', 'required'=>true] ).
            '<span class='.$llave.'>'.
                Form::label($llave.'[1][apellido_paterno]','Apellido Paterno', ['class'=>'']).
                Form::text($llave.'[1][apellido_paterno]', null, ['class' => 'form-control'] ).
                Form::label($llave.'[1][apellido_materno]','Apellido Materno', ['class'=>'']).
                Form::text($llave.'[1][apellido_materno]', null, ['class' => 'form-control'] ).
                Form::text($llave.'[1][id_p]', null, ['class' => 'form-control id_p '.$llave, 'id' => $llave.'[1][id_p]']).
                 '<div class="form-group">' .
                Form::button('<i class="glyphicon glyphicon-trash"></i> Eliminar Persona', ['class' => 'btn btn-warning quitarPersona', 'type' => 'button', 'title'=>'Eliminar colindancia']) .
            '</fieldset>'.
            '</div>'.
            '</div>'.
            '</div>'.
        '</span>' ;
    return $personas;
});
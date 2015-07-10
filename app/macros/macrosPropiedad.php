<?php
Form::macro('propiedad', function($llave)
{
  $predios='
   <div class="row">
    <div class="col-md-6">'.
    Form::label($llave . '[]', 'Bajo el numero:') .
    Form::text($llave.'[numerocontro]', null, ['class' => 'form-control'] ).
    '</div>'.
    ' <div class="col-md-6">'.
     Form::label($llave . '[]', 'Folio' ) .
    Form::text($llave.'[folio]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[]', 'Clave') .
    Form::text($llave.'[clave]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[]', 'Predio') .
    Form::text($llave.'[predio]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[]', 'L.M.V :') .
    Form::text($llave.'[lmv]', null, ['class' => 'form-control'] ).
    '</div>
    </div>';
    return $predios;
});
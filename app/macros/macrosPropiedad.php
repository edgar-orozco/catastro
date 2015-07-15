<?php
Form::macro('propiedad', function($llave)
{
  $predios='
   <div class="row">
    <div class="col-md-6">'.
    Form::label($llave . '[numerocontro]', 'Bajo el numero:') .
    Form::text($llave.'[numerocontro]', null, ['class' => 'form-control'] ).
    '</div>'.
    ' <div class="col-md-6">'.
     Form::label($llave . '[folio]', 'Folio' ) .
    Form::text($llave.'[folio]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[clave]', 'Clave') .
    Form::text($llave.'[clave]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[predio]', 'Predio') .
    Form::text($llave.'[predio]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[lmv]', 'L.M.V :') .
    Form::text($llave.'[lmv]', null, ['class' => 'form-control'] ).
    '</div>
    </div>';
    return $predios;
});
<?php
Form::macro('propiedad', function($llave)
{
  $predios='
   <div class="row">
    <div class="col-md-6">'.
    Form::label($llave . '[antecedente_num]', 'Bajo el numero:') .
    Form::text($llave.'[antecedente_num]', null, ['class' => 'form-control'] ).
    '</div>'.
    ' <div class="col-md-6">'.
     Form::label($llave . '[antecedente_folio]', 'Folio' ) .
    Form::text($llave.'[antecedente_folio]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[clave_antecedente]', 'Clave') .
    Form::text($llave.'[clave_antecedente]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[predio_antecedente]', 'Predio') .
    Form::text($llave.'[predio_antecedente]', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label($llave . '[lvm_antecedente]', 'L.M.V :') .
    Form::text($llave.'[lvm_antecedente]', null, ['class' => 'form-control'] ).
    '</div>
    </div>';
    return $predios;
});
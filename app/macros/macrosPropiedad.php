<?php
Form::macro('propiedad', function()
{
  $predios='
   <div class="row">
    <div class="col-md-6">'.
    Form::label('antecedente_num', 'Bajo el numero:') .
    Form::text('antecedente_num', null, ['class' => 'form-control'] ).
    '</div>'.
    
    '<div class="col-md-6">'.
    Form::label('valor_registro', 'Valor con Registro Estatal no: ') .
    Form::text('valor_registro', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label('folio_avaluo]', 'No. De Folio de Avaluó:').
    Form::text('folio_avaluo', null, ['class' => 'form-control'] ). 
   '</div>'.
    '<div class="col-md-6">'.
    Form::label('valor_comercial', 'Valor Comercial del Inmueble:') .
    Form::text('valor_comercial', null, ['class' => 'form-control'] ).
    '</div>
    </div>';
    return $predios;
});
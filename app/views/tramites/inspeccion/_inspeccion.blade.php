
<fieldset><legend>DATOS DEL PREDIO</legend>
            <div class="form-group">
                {{Form::label('ubicacion','UBICACIÓN (CALLE Y NÚMERO)')}}
                {{Form::text('ubicacion', null, ['class' => 'form-control'])}}
                {{$errors->first('ubicacion', '<span class=text-danger>:message</span>')}}
            </div>


<div class="col-md-6 form-group">
      {{Form::label('unidad','UNIDADA, CONJUNTO HABITACIONAL/FRACIONAMIENTO')}}
      {{Form::text('unidad', null, ['class' => 'form-control'])}}
      {{$errors->first('unidad', '<span class=text-danger>:message</span>')}}

</div>
<div class="col-md-6 form-group">
      {{Form::label('colonia','COLONIA')}}
      {{Form::text('colonia', null, ['class' => 'form-control'])}}
      {{$errors->first('colonia', '<span class=text-danger>:message</span>')}}
</div>

<div class="col-md-4 form-group">
    {{Form::label('cp','CODIGO POSTAL')}}
    {{Form::text('cp', null, ['class' => 'form-control'])}}
    {{$errors->first('cp', '<span class=text-danger>:message</span>')}}

</div>
<div class="col-md-4 form-group">
    {{Form::label('rancheria','RANCHERIA/EJIDO')}}
    {{Form::text('rancheria', null, ['class' => 'form-control'])}}
    {{$errors->first('rancheria', '<span class=text-danger>:message</span>')}}

</div>
<div class="col-md-4 form-group">
    {{Form::label('poblacion','POBLACION/VILLA')}}
    {{Form::text('poblacion', null, ['class' => 'form-control'])}}
    {{$errors->first('poblacion', '<span class=text-danger>:message</span>')}}

</div>
<div class="col-md-4 form-group">
    {{Form::label('municipio','MUNICIPIO')}}
    {{Form::text('municipio', null, ['class' => 'form-control'])}}
    {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}

</div>
</fieldset>

<fieldset><legend>COLINDANTES</legend>

  <div class="col-md-12 form-group">
            {{Form::colindancias('colindancia',$JsonColindancias)}}
  </div>

</fieldset>


<fieldset>

 <div class="col-md-6 form-group">
    {{Form::label('sup_terreno','SUPERFICIE TERRENO')}}
    {{Form::text('sup_terreno', null, ['class' => 'form-control'])}}
    {{$errors->first('sup_terreno', '<span class=text-danger>:message</span>')}}

 </div>
 <div class="col-md-6 form-group">
    {{Form::label('sup_construccion','SUPERFICIE CONSTRUCCION')}}
    {{Form::text('sup_construccion', null, ['class' => 'form-control'])}}
    {{$errors->first('sup_construccion', '<span class=text-danger>:message</span>')}}

 </div>

</fieldset>
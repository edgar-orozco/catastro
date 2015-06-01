{{--ToDo: Corregir estilos--}}
    {{Form::label('clave','Clave')}}
    {{Form::hidden('clave', $predio->clave, ['class'=>'form-control'])}}
    {{$errors->first('clave', '<span class=text-danger>:message</span>')}}

    {{Form::label('cuenta','Cuenta')}}
    {{Form::hidden('cuenta', $predio->cuenta, ['class'=>'form-control'])}}
    {{$errors->first('cuenta', '<span class=text-danger>:message</span>')}}


    {{--Vendedor --}}
    <div class="form-group col-md-6">

     <h1> Vendedor </h1>

    {{--{{Form::label('vendedor_id','Vendedor')}}
    {{Form::text('vendedor_id', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('vendedor_id', '<span class=text-danger>:message</span>')}}--}}

    <div class="">
        {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
        <div class="btn-group btn-toggle" data-toggle="buttons">
            <label class="btn btn-sm btn-default active" style="width: 49%;">
                <input type="radio" name="vendedor_tipo_persona" class="radio-persona"
                       value="F" checked> Física
            </label>
            <label class="btn btn-sm btn-default"  style="width: 49%;">
                <input type="radio" name="vendedor_tipo_persona" class="radio-persona"
                       value="M"> Moral
            </label>
        </div>
    </div>

    {{--{{Form::label('vendedor_tipo','Vendedor Tipo')}}
    {{Form::text('vendedor_tipo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('vendedor_tipo', '<span class=text-danger>:message</span>')}}--}}


     {{Form::label('vendedor_nombres','Nombre', ['class'=>''])}}
     {{Form::text('vendedor_nombres', null, ['class' => 'form-control', 'required'=>true] )}}

    {{Form::label('vendedor_apellido_paterno','Apellido Paterno', ['class'=>''])}}
    {{Form::text('vendedor_apellido_paterno', null, ['class' => 'form-control'] )}}

    {{Form::label('vendedor_apellido_materno','Apellido Materno', ['class'=>''])}}
    {{Form::text('vendedor_apellido_materno', null, ['class' => 'form-control'] )}}

    {{Form::label('vendedor_curp','CURP', ['class'=>''])}}
    {{Form::text('vendedor_curp', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18'] )}}

    {{Form::label('vendedor_rfc','RFC', ['class'=>''])}}
    {{Form::text('vendedor_rfc', null, ['class' => 'form-control', 'minlength'=>'12', 'maxlength'=>'13'] )}}
    {{--/Vendedor --}}
</div>


 {{--Vendedor --}}
    <div class="form-group col-md-6">
    <h1> Comprador </h1>
    {{--{{Form::label('comprador_id','Comprador')}}
    {{Form::text('comprador_id', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('comprador_id', '<span class=text-danger>:message</span>')}}

    {{Form::label('comprador_tipo','Vendedor')}}
    {{Form::text('comprador_tipo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('comprador_tipo', '<span class=text-danger>:message</span>')}}--}}

    <div class="">
        {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
        <div class="btn-group btn-toggle" data-toggle="buttons">
            <label class="btn btn-sm btn-default active" style="width: 49%;">
                <input type="radio" name="comprador_tipo_persona" class="radio-persona"
                       value="F" checked> Física
            </label>
            <label class="btn btn-sm btn-default"  style="width: 49%;">
                <input type="radio" name="vendedor_tipo_persona" class="radio-persona"
                       value="M"> Moral
            </label>
        </div>
    </div>

   {{-- {{Form::label('comprador_tipo','Comprador Tipo')}}
    {{Form::text('comprador_tipo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('comprador_tipo', '<span class=text-danger>:message</span>')}}--}}


     {{Form::label('comprador_nombres','Nombre', ['class'=>''])}}
     {{Form::text('comprador_nombres', null, ['class' => 'form-control', 'required'=>true] )}}

    {{Form::label('comprador_apellido_paterno','Apellido Paterno', ['class'=>''])}}
    {{Form::text('comprador_apellido_paterno', null, ['class' => 'form-control'] )}}

    {{Form::label('comprador_apellido_materno','Apellido Materno', ['class'=>''])}}
    {{Form::text('comprador_apellido_materno', null, ['class' => 'form-control'] )}}

    {{Form::label('comprador_curp','CURP', ['class'=>''])}}
    {{Form::text('comprador_curp', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18'] )}}

    {{Form::label('comprador_rfc','RFC', ['class'=>''])}}
    {{Form::text('comprador_rfc', null, ['class' => 'form-control', 'minlength'=>'12', 'maxlength'=>'13'] )}}
    {{--/Vendedor --}}
</div>

<div class="form-group col-md-6">

<h1>Datos del predio</h1>

    {{Form::label('superficie_vendida','Superficie vendida M2')}}
    {{Form::number('superficie_vendida', null, ['class'=>'form-control', 'autofocus'=> 'autofocus','min' => 0] )}}
    {{$errors->first('superficie_vendida', '<span class=text-danger>:message</span>')}}

    {{Form::label('superficie_construccion_vendida','Superficie construcción vendida M2')}}
    {{Form::number('superficie_construccion_vendida', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'min' => 0] )}}
    {{$errors->first('superficie_construccion_vendida', '<span class=text-danger>:message</span>')}}

    {{Form::label('medidas_colindancias','Medidas colindancias')}}
    {{Form::text('medidas_colindancias', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('medidas_colindancias', '<span class=text-danger>:message</span>')}}

</div>
<div class="form-group col-md-6">
  <h1>Datos de la escritura precedente</h1>

{{Form::label('escritura_fecha','Escritura de fecha')}}
{{Form::text('escritura_fecha', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
{{$errors->first('escritura_fecha', '<span class=text-danger>:message</span>')}}

{{Form::label('escritura_registro','N° registro')}}
{{Form::text('escritura_registro', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
{{$errors->first('escritura_registro', '<span class=text-danger>:message</span>')}}

{{Form::label('escritura_predio','Predio')}}
{{Form::text('escritura_predio', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
{{$errors->first('escritura_predio', '<span class=text-danger>:message</span>')}}

{{Form::label('escritura_folio','Folio')}}
{{Form::text('escritura_folio', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
{{$errors->first('escritura_folio', '<span class=text-danger>:message</span>')}}

{{Form::label('escritura_volumen','Volumen')}}
{{Form::text('escritura_volumen', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
{{$errors->first('escritura_volumen', '<span class=text-danger>:message</span>')}}

{{Form::label('escritura_impuesto_desde','Impuesto pagado del')}}
{{Form::text('escritura_impuesto_desde', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
{{$errors->first('escritura_impuesto_desde', '<span class=text-danger>:message</span>')}}

{{Form::label('escritura_impuesto_hasta','Al')}}
{{Form::text('escritura_impuesto_hasta', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
{{$errors->first('escritura_impuesto_hasta', '<span class=text-danger>:message</span>')}}



</div>
<br>


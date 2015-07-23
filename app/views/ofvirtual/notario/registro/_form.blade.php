
{{HTML::script('js/macros.js')}}
{{Form::hidden('registro[clave]', $predio->clave, ['class'=>'form-control'])}}
{{$errors->first('registro[clave]', '<span class=text-danger>:message</span>')}}

{{Form::hidden('registro[cuenta]', $predio->cuenta, ['class'=>'form-control'])}}
{{$errors->first('registro[cuenta]', '<span class=text-danger>:message</span>')}}

<div class="row">
  <div class="panel panel-default">
        <div class="panel-body">
  {{Form::notaria($notaria)}}




<div class="row-fluid">
<div class="col-md-6">
      {{Form::label('tesoreria','Tesorería Municipal:')}}
      {{Form::text('tesoreria', null, ['class' => 'form-control'] )}}
</div>
 <div class="col-md-6">
      {{Form::label('municipio','Municipio:')}}
      {{Form::select('municipio', $municipio, null, ['class'=>'form-control'])}}
</div>

<div class="col-md-3">
      {{Form::label('escritura','Nomero de escritura:')}}
      {{Form::text('escritura', null, ['class' => 'form-control'] )}}
</div>
<div class="col-md-3">
      {{Form::label('volumen','Volumen:')}}
      {{Form::text('volumen', null, ['class' => 'form-control'] )}}
</div>
<div class="col-md-3">
    {{Form::label('cuenta','No. de cuenta:')}}
    {{Form::text('cuenta', null, ['class' => 'form-control'] )}}
</div>
<div class="col-md-3">
    {{Form::label('tipo_predio','Tipo de predio:')}}
    {{Form::select('tipo_predio', ['U' => 'Urbano','R' => 'Rustico'], null, ['class' => 'form-control focus'])}}
</div>
<div class="col-md-6">
    {{Form::label('clave_catastral','Clave Catastral:')}}
    {{Form::text('clave_catastral', null, ['class' => 'form-control'] )}}
</div>
<div class="col-md-6">
    {{Form::label('acto','Naturaleza del acto:')}}
    {{Form::text('acto', null, ['class' => 'form-control'] )}}
</div>
</div>
</div></div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos Personas</h3>
    </div>
<div class="panel-body">
        <!--<div class="row">-->
        {{--adquiriente --}}
        <div class="form-group col-md-6">
            <h3> Enajenante </h3>
<div class=" form-group " >

    {{--Form::text('adquiriente', null, ['class' => 'form-control'] )--}}
    {{form::personas('enajenante')}}

    {{Form::label('direccion_e','Diección del enajenante:')}}
    {{Form::text('direccion_e', null, ['class' => 'form-control'] )}}
</div>
</div>



        <!--<div class="row">-->
        {{--adquiriente --}}
        <div class="form-group col-md-6">
            <h3> Aquiriente </h3>
<div class=" form-group " >

    {{--Form::text('adquiriente', null, ['class' => 'form-control'] )--}}
    {{form::personas('adquiriente')}}

    {{Form::label('direccion_a','Diección del adquiriente:')}}
    {{Form::text('direccion_a', null, ['class' => 'form-control'] )}}
</div>
</div>


</div>
</div>
<div class="col-md-3">
     {{Form::label('fecha_inst','Fecha de Intrumento')}}
     {{Form::text('fecha_inst', null,['id'=>'datepicker', 'class'=>'btn btn-default btn-sm dropdown-toggle'] )}}
</div>
<div class="col-md-3">
      {{Form::label('fecha_firma','Fecha de firma')}}
      {{Form::text('fecha_firma',null, ['id'=>'datepicker1', 'class'=>'btn btn-default btn-sm dropdown-toggle'] )}}
</div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos del Inmueble</h3>
    </div>

    <div class="row-fluid panel-body">
        <div class="col-md-12">
            {{Form::label('ubicacion_inmu','Ubicacion del Inmueble:')}}
            {{Form::text('ubicacion_inmu', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-6">
            {{Form::label('superficie_construc','Superficie de construccion:')}}
            {{Form::number('superficie_construc', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-6">
            {{Form::label('superficie_terreno','Superficie del terrreno:')}}
            {{Form::number('superficie_terreno', null, ['class' => 'form-control'] )}}
        </div>
         <div class="col-md-6">
            {{Form::label('niveles','Niveles:')}}
            {{Form::number('niveles', null, ['class' => 'form-control'] )}}
        </div>
         <div class="col-md-6">
            {{Form::label('estado_conserv','Estado de conservacion:')}}
            {{Form::text('estado_conserv', null, ['class' => 'form-control'] )}}
        </div>

</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Colindancias</h3>
    </div>
 <div class="row-fluid panel-body">
        <div class="col-md-12">
            {{Form::colindancias('escrituras','sur')}}
        </div>
  </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ANTECEDENTES DE LA PROPIEDAD</h3>
    </div>
 <div class="row-fluid panel-body">

        <div class="col-md-12">
            {{Form::propiedad('escrituras')}}
        </div>
</div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ANTECEDENTES DE LA PROPIEDAD</h3>
    </div>
    <div class="row-fluid panel-body">
        <div class="col-md-6">
            {{Form::label('valor_catastral','Valor Catastral:')}}
            {{Form::number('valor_catastral', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-6">
            {{Form::label('import_opera','Importe de la operación:')}}
            {{Form::number('import_opera', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-6">
            {{Form::label('import_avaluo','Importe del avalúo:')}}
            {{Form::number('import_avaluo', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-6">
            {{Form::label('avaluo_efec','Avaluo efectuado por:')}}
            {{Form::text('avaluo_efec', null, ['class' => 'form-control'] )}}
        </div>
    </div>
</div>

<div class="form-actions form-group col-md-6" style="clear:both; ">
                  {{ Form::submit('Crear nuevo traslado de dominio', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
                </div>






<script>

   //Calendario
$(function() {
    $( "#datepicker" ).datepicker();
  });
//Cambiar a español el calendario
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: '',
 beforeShowDay: $.datepicker.noWeekends
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});

$(function() {
    $( "#datepicker1" ).datepicker();
  });
//Cambiar a español el calendario
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: '',
 beforeShowDay: $.datepicker.noWeekends
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>
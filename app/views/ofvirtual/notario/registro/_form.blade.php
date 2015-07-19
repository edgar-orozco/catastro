{{ HTML::style('js/jquery/jquery-ui.css') }}

{{ HTML::script('js/jquery/jquery-ui.js') }}


{{ Form::open(array('url' => '', 'method' => 'post', 'name' => 'formulario', 'id' => 'formulario'))}}
<fieldset>
  <legend>DATOS DEL NOTARIO</legend>
  <div class="form-group">
  {{Form::notaria(1)}}
</div>
</fieldset>
<fieldset>
<legend></legend>
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
</fieldset>
<fieldset>
  <legend>Nombre del Enajenante </legend>
  <p>Pregunta... (<a href="#" id="alternar-respuesta-ej1">ver respuesta</a>)
<div class="col-md-12 add" id="respuesta-ej1" style="display:none">
    {{Form::label('adquiriente','')}}
    {{--Form::text('adquiriente', null, ['class' => 'form-control'] )--}}
    <div class="col-md-12" id="adq">{{form::personas('enajenante')}}</div>
</div>
<div class="col-md-12">
    {{Form::label('direccion_e','Diección del enajenante:')}}
    {{Form::text('direccion_e', null, ['class' => 'form-control'] )}}
</div>
</fieldset>
<fieldset>
  <legend>Nombre del Adquiriente </legend>
<div class="col-md-12">
    {{Form::label('adquiriente','')}}
    {{--Form::text('adquiriente', null, ['class' => 'form-control'] )--}}
    <div class="col-md-12" id="adq">{{form::personas('adquiriente')}}</div>
</div>
<div class="col-md-12">
    {{Form::label('direccion_a','Diección del adquiriente:')}}
    {{Form::text('direccion_a', null, ['class' => 'form-control'] )}}
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
</fieldset>
<fieldset>
  <legend>DATOS DEL INMUEBLE</legend>
    <div class="row-fluid">
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
</fieldset>
<fieldset>
<legend>COLINDANCIAS</legend>
        <div class="col-md-12">
            {{Form::colindancias('escrituras','sur')}}
        </div>
</fieldset>
<fieldset>
<legend>ANTECEDENTES DE LA PROPIEDAD</legend>
        <div class="col-md-12">
            {{Form::propiedad('escrituras')}}
        </div>
</fieldset>

<fieldset>
<legend>ANTECEDENTES DE LA PROPIEDAD</legend>
    <div class="row-fluid">
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
</fieldset>
<fieldset>
<legend></legend>
<div class="form-actions form-group col-md-12">
            {{ Form::submit('Guardar Datos', array('class' => 'btn btn-primary')) }}
            {{ Form::reset('Limpiar ', ['class' => 'btn btn-warning']) }}
        </div>
</fieldset>

    </div>
 {{Form::close()}}



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
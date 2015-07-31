{{HTML::script('js/macros.js')}}
{{ HTML::style('js/jquery/jquery-ui.css') }}
{{ HTML::script('js/jquery/jquery-ui.js') }}
{{HTML::script('http://jqueryvalidation.org/files/dist/jquery.validate.min.js')}}
{{HTML::script('http://jqueryvalidation.org/files/dist/additional-methods.min.js')}}
{{HTML::script('js/registro_escritura/validacion.js')}}
{{HTML::script('js/registro_escritura/validacion_esp.js')}}

{{Form::hidden('registro[clave]', $predio->clave, ['class'=>'form-control'])}}
{{$errors->first('registro[clave]', '<span class=text-danger>:message</span>')}}

{{Form::hidden('registro[cuenta]', $predio->cuenta, ['class'=>'form-control'])}}
{{$errors->first('registro[cuenta]', '<span class=text-danger>:message</span>')}}

<div class="row">
  <div class="panel panel-default">
        <div class="panel-body">
  {{Form::notaria($notaria)}}
    {{Form::hidden('notaria_id',$notaria,['class' => 'form-control'])}}



<div class="row-fluid">
    <div class="panel-body">
        <h3>Tipo de escritura</h3>

                {{Form::label('tipo_escritura','Publica', ['class'=>''])}}
                 {{Form::radio('tipo_escritura', 'publica', null, ['class'=>'-radio-persona ' ])}}
                {{Form::label('tipo_escritura','Privada', ['class'=>''])}}
                 {{Form::radio('tipo_escritura', 'privada', null, ['class'=>'-radio-persona'])}}
                 {{Form::label('tipo_escritura','Titulo', ['class'=>''])}}
                 {{Form::radio('tipo_escritura', 'titulos', null, ['class'=>'-radio-persona'])}}
    </div>




<div class="col-md-3">
      {{Form::label('volumen','Volumen:')}}
      {{Form::text('volumen', null, ['class' => 'form-control numeros'] )}}
</div>
<div class="col-md-3">
    {{Form::label('cuenta','No. de cuenta:')}}
    {{Form::text('cuenta', null, ['class' => 'form-control numeros'] )}}
</div>
<div class="col-md-3">
    {{Form::label('tipo_predio','Tipo de predio:')}}
    {{Form::select('tipo_predio', ['U' => 'Urbano','R' => 'Rustico'], null, ['class' => 'form-control focus'])}}
</div>
<div class="col-md-6">
    {{Form::label('clave','Clave Catastral:')}}
    {{Form::text('clave', null, ['class' => 'form-control clave_cata'] )}}
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
        <h3 class="panel-title">Dirección Enajenante</h3>
        {{Form::domicilio('enajenanteDomicilio',$vialidad,$entidad,$asentamiento,$municipio)}}
    {{--Form::label('direccion_e','Diección del enajenante:')--}}
    {{--Form::text('direccion_e', null, ['class' => 'form-control'] )--}}
</div>
</div>



        <!--<div class="row">-->
        {{--adquiriente --}}
        <div class="form-group col-md-6">
            <h3> Aquiriente </h3>
<div class=" form-group " >

    {{--Form::text('adquiriente', null, ['class' => 'form-control'] )--}}
    {{form::personas('adquiriente')}}

    <h3 class="panel-title">Dirección Adquiriente</h3>
        {{Form::domicilio('adquirienteDomicilio',$vialidad,$entidad,$asentamiento,$municipio)}}
    {{--Form::label('direccion_a','Diección del adquiriente:')--}}
    {{--Form::text('direccion_a', null, ['class' => 'form-control'] )--}}
</div>
</div>


</div>
</div>

</div>
<div class="row">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos del Inmueble</h3>
    </div>

    <div class="row-fluid panel-body">
        <div class="col-md-12">
            {{Form::label('ubicacion_inmu','Ubicacion del Inmueble:')}}
            {{Form::text('ubicacion_inmu', null, ['class' => 'form-control requerido'] )}}
        </div>
        <div class="col-md-6">
            {{Form::label('superficie_construc','Superficie de construccion:')}}
            {{Form::number('superficie_construc', null, ['class' => 'form-control numeros'] )}}
        </div>
        <div class="col-md-6">
            {{Form::label('superficie_terreno','Superficie del terrreno:')}}
            {{Form::number('superficie_terreno', null, ['class' => 'form-control numeros'] )}}
        </div>
         <div class="col-md-6">
            {{Form::label('niveles','Niveles:')}}
            {{Form::number('niveles', null, ['class' => 'form-control numeros'] )}}
        </div>
         <div class="col-md-6">
            {{Form::label('estado_conserv','Estado de conservacion:')}}
            {{Form::text('estado_conserv', null, ['class' => 'form-control requerido'] )}}
        </div>

</div>
</div>
</div>
<div class="row">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Colindancias</h3>
    </div>
 <div class="row-fluid panel-body">
        <div class="col-md-12">
            {{Form::colindancias('colindancia',$JsonColindancias)}}
        </div>
  </div>
</div>
</div>
<div class="row">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ANTECEDENTES DE LA PROPIEDAD</h3>
    </div>
 <div class="row-fluid panel-body">

        <div class="col-md-12">
            {{Form::propiedad('propiedad')}}
        </div>
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
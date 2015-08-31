@extends('layouts.default')

@section('title')
{{$title}}::@parent
@stop

{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop

@section('content')
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Datos del Predio</a></li>
    <li><a href="#tabs-2">Datos del Propietario</a></li>
    <li><a href="#tabs-3">Datos Fiscales y del Regístro Público</a></li>
    <li><a href="#tabs-4">construcción, Servicios Indecadores y Fecha Modificación</a></li>
  </ul>
  <div id="tabs-1">
    @include('reportes.memos._form_DatosPredio')
  </div>
  <div id="tabs-2">
    @include('reportes.memos._form_DatosPropietario')
  </div>
  <div id="tabs-3">
    @include('reportes.memos._form_DatosFiscales')
  </div>
  <div id="tabs-4">
    @include('reportes.memos._form_DatosConstruccion')
  </div>
</div>
@stop

@section('javascript')
{{HTML::script('js/macros.js')}}
    {{ HTML::script('js/select2/select2.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}
    {{ HTML::script('js/bootstrap-datepicker.js') }}
    {{ HTML::script('js/bootstrap-datepicker.es.js') }}
{{ HTML::script('js/jquery/jquery-ui.js') }}
    {{ HTML::script('js/jquery/jquery-ui-autocomplete.min.js') }}
    {{ HTML::style('js/jquery/jquery-ui.css') }}
<script>   
$(function() {

   
    $( ".fecha" ).datepicker();
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
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: '',
 beforeShowDay: $.datepicker.noWeekends
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

    $(function() {
      $( "#tabs" ).tabs();
    });
</script>
@append
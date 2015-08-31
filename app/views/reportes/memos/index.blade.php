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
    
  </div>
  <div id="tabs-3">
    
  </div>
  <div id="tabs-4">
    
  </div>
</div>
@stop

@section('javascript')
<script>   
    $(function() {
      $( "#tabs" ).tabs();
    });
</script>
@append
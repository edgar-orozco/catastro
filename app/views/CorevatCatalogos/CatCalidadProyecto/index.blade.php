@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatCalidadProyecto')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatCalidadProyectoController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatCalidadProyecto._list', compact('CatCalidadProyecto'))
</div>
@stop

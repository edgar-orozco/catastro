@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatClasificacionZona')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatClasificacionZonaController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatClasificacionZona._list', compact('CatClasificacionZona'))
</div>
@stop

@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatEstadoConservacion')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatEstadoConservacionController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatEstadoConservacion._list', compact('CatEstadoConservacion'))
</div>
@stop

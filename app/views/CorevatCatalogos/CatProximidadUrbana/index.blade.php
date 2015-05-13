@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatProximidadUrbana')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatProximidadUrbanaController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatProximidadUrbana._list', compact('CatProximidadUrbana'))
</div>
@stop

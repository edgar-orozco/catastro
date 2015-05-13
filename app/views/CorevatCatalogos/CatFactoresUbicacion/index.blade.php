@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatFactoresUbicacion')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatFactoresUbicacionController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatFactoresUbicacion._list', compact('CatFactoresUbicacion'))
</div>
@stop

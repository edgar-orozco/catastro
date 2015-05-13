@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatFactoresZonas')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatFactoresZonasController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatFactoresZonas._list', compact('CatFactoresZonas'))
</div>
@stop

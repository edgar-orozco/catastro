@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatFactoresConservacion')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatFactoresConservacionController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatFactoresConservacion._list', compact('CatFactoresConservacion'))
</div>
@stop

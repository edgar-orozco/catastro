@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatOrientaciones')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatOrientacionesController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatOrientaciones._list', compact('CatOrientaciones'))
</div>
@stop

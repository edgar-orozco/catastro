@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatCimentaciones')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatCimentacionesController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatCimentaciones._list', compact('CatCimentaciones'))
</div>
@stop

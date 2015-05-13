@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatNiveles')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatNivelesController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatNiveles._list', compact('CatNiveles'))
</div>
@stop

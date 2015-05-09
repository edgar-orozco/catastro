@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatPisos')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatPisosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatPisos._list', compact('CatPisos'))
</div>
@stop

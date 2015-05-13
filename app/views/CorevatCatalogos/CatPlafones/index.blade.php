@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatPlafones')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatPlafonesController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatPlafones._list', compact('CatPlafones'))
</div>
@stop

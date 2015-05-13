@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatAplanados')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatAplanadosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatAplanados._list', compact('CatAplanados'))
</div>
@stop

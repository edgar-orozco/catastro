@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatMuros')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatMurosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatMuros._list', compact('CatMuros'))
</div>
@stop

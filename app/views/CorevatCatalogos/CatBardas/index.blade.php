@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatBardas')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatBardasController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatBardas._list', compact('CatBardas'))
</div>
@stop

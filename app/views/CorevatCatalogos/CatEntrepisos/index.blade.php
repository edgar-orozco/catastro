@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatEntrepisos')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatEntrepisosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatEntrepisos._list', compact('CatEntrepisos'))
</div>
@stop

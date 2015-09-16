@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatTituloPersona')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatTituloPersonaController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatTituloPersona._list', compact('CatTituloPersona'))
</div>
@stop

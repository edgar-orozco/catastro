@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatTechos')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatTechosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatTechos._list', compact('CatTechos'))
</div>
@stop

@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatRegimenPropiedad')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatRegimenPropiedadController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatRegimenPropiedad._list', compact('CatRegimenPropiedad'))
</div>
@stop

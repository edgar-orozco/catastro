@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatClaseGeneralInmueble')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatClaseGeneralInmuebleController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatClaseGeneralInmueble._list', compact('CatClaseGeneralInmueble'))
</div>
@stop

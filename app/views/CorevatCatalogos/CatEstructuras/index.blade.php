@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatEstructuras')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatEstructurasController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatEstructuras._list', compact('CatEstructuras'))
</div>
@stop

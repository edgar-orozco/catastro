@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatUsosSuelos')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatUsosSuelosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatUsosSuelos._list', compact('CatUsosSuelos'))
</div>
@stop

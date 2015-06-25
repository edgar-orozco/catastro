@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/estados')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_EstadosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Agregar Estado
    </a>
</div>
<br />
<div class="row">
	@include('CorevatCatalogos.Estados._list', compact('Estados'))
</div>
@stop

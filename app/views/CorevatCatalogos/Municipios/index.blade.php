@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/municipios')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_MunicipiosController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Agregar Municipios
    </a>
</div>
<br />
<div class="row">
	@include('CorevatCatalogos.Municipios._list', compact('rows'))
</div>
@stop

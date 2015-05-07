@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/empresas')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_EmpresasController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear Empresa
    </a>
</div>
<br />
<div class="row">
	@include('CorevatCatalogos.Empresas._list', compact('Empresas'))
</div>
@stop

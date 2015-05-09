@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatTipo')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatTipoController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatTipo._list', compact('CatTipo'))
</div>
@stop

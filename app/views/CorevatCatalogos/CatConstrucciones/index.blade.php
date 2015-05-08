@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatConstrucciones')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatConstruccionesController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatConstrucciones._list', compact('CatConstrucciones'))
</div>
@stop

@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatFactoresSuperficie')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatFactoresSuperficieController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatFactoresSuperficie._list', compact('CatFactoresSuperficie'))
</div>
@stop

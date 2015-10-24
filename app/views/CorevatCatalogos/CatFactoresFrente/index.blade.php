@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatFactoresFrente')) }}
<div class="row">
	<a class="btn btn-info" href="{{action('corevat_CatFactoresFrenteController@create')}}" role="button">
		<span class="glyphicon glyphicon-plus"></span> Crear
	</a>
</div>
<br>
<div class="row">
	@include('CorevatCatalogos.CatFactoresFrente._list', compact('CatFactoresFrente'))
</div>
@stop

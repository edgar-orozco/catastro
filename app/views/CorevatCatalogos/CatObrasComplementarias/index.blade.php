@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
{{ Form:: open(array('url'=>'corevat/CatObrasComplementarias')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('corevat_CatObrasComplementariasController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear
    </a>
</div>
<br />
<div class="row">
	@include('CorevatCatalogos.CatObrasComplementarias._list', compact('CatObrasComplementarias'))
</div>
@stop

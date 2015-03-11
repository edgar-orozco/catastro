@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')
{{ Form:: open(array('url'=>'catalogos/configuracion')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('catalogos_configuracionController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear configuracion municipal
    </a>
</div>
<br>
<div class="row">
    @include('catalogos.configuracion._list', compact('configuracionMunicipal'))
</div>
@stop


@extends('layouts.default')

@section('title')
{{{ $title}}} :: @parent
@stop

@section('content')
{{ Form:: open(array('url'=>'catalogos/salario')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('catalogos_salarioController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear salario minimo
    </a>
</div>
<br>
<div class="row">
    @include('catalogos.salario._list', compact('salario'))
</div>
@stop

@extends('layouts.default')

@section('title')
{{{ $title}}} :: @parent
@stop

@section('content')
{{ Form:: open(array('url'=>'catalogos/ejecutores')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('catalogos_ejecutoresController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear ejecución
    </a>
</div>
<br>
<div class="row">
   
    @include('catalogos.ejecutores._list', compact('ejecutoress'))

</div>

@stop

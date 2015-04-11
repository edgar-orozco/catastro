@extends('layouts.default')

@section('title')
{{{ $title}}} :: @parent
@stop

@section('content')
{{ Form:: open(array('url'=>'catalogos/inpc')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('catalogos_inpcController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear INPC
    </a>
</div>
<br>
<div class="row">
    @include('catalogos.inpc._list', compact('inpcs'))
</div>
<!-- prueba -->
@stop
<!--prueba-->

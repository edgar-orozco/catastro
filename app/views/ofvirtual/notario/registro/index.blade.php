@extends('layouts.default')

@section('title')
{{{ $title}}} :: @parent
@stop

@section('content')
<!--<div class="row">
    <a class="btn btn-info" href="{{action('ofvirtual_RegistroEscrituraController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Capturar 
    </a>
</div> -->
<div class="row">

     @include('ofvirtual.notario.registro._form',compact('municipios'))
 
</div>

<!-- listado traslados -->
    <div class="row">
        @include('ofvirtual.notario.registro._list', compact('registro'))
    </div><!-- /.row -->
@stop
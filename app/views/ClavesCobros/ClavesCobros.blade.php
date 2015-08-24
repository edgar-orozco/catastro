@extends('layouts.default')

@section('title')

@stop

@section('content')
<div class="page-header">
    <h3>
        Administrador Claves. 
    </h3>
    <h4>Crear, modificar, asignar Claves.</h4>
</div>
{{ Form::open(array('url' => 'agregarclave', 'method' => 'GET')) }}

<div class="row">


    <a class="btn btn-info"  href="{{action('ClavesCobrosController@CrearValores')}}"  role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear Claves
    </a>


</div><!-- /.row -->

<br>
 <div class="row">
        @include('ClavesCobros._list')
    </div>

@stop

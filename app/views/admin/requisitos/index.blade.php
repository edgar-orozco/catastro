@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

    {{ Form::open(array('url' => 'admin/requisitos', 'method' => 'GET')) }}

    <div class="row">

        <a class="btn btn-info" href="{{action('RequisitosController@create')}}" role="button">
          <span class="glyphicon glyphicon-plus"></span> Crear Requisito
        </a>

    </div><!-- /.row -->

    <br>
    <div class="row">
        @include('admin.requisitos._list', compact('requisitos'))
    </div>

@stop

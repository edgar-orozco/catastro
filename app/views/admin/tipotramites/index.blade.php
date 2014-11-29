@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

    {{ Form::open(array('url' => 'admin/tipotramites', 'method' => 'GET')) }}

    <div class="row">

        <a class="btn btn-info" href="{{action('TipotramitesController@create')}}" role="button">
          <span class="glyphicon glyphicon-plus"></span> Crear Tipo de Trámite
        </a>

    </div><!-- /.row -->

    <br>
    <div class="row">
        @include('admin.tipotramites._list', compact('tipotramites'))
    </div>

@stop

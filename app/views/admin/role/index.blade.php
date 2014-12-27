@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

    {{ Form::open(array('url' => 'admin/role', 'method' => 'GET')) }}

    <div class="row">


        <a class="btn btn-info" href="{{action('AdminRolesController@create')}}" role="button">
          <span class="glyphicon glyphicon-plus"></span> Crear rol
        </a>


    </div><!-- /.row -->

    <br>
    <div class="row">
        @include('admin.role._list', compact('roles'))
    </div>

@stop


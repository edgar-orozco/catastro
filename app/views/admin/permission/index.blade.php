@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

    {{ Form::open(array('url' => 'admin/permission', 'method' => 'GET')) }}

    <div class="row">

        <a class="btn btn-info" href="{{action('AdminPermissionsController@create')}}" role="button">
          <span class="glyphicon glyphicon-plus"></span> Crear Permiso
        </a>

    </div><!-- /.row -->

    <br>
    <div class="row">
        @include('admin.permission._list', compact('permissions'))
    </div>

@stop


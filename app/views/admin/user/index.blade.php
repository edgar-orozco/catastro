@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('menu')
    @include('admin.menu')
@append

@section('content')

    {{ Form::open(array('url' => 'admin/user', 'method' => 'GET')) }}

    <div class="row">
        <div class="col-sm-6">

        <a class="btn btn-info" href="{{action('AdminUserController@create')}}" role="button">
          <span class="glyphicon glyphicon-plus"></span> Crear usuario
        </a>

        </div>

        <div class="col-sm-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search"></span>
                </span>
                {{Form::text('q', null, ['class'=>'form-control', 'placeholder'=>'Buscar por...'] )}}

                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Nombre <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="#">Apellido paterno</a></li>
                        <li><a href="#">Apellido materno</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Email</a></li>
                        <li><a href="#">Usuario</a></li>
                        <li><a href="#">Rol</a></li>
                    </ul>
                </div><!-- /btn-group -->
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->

    </div><!-- /.row -->

    <br>
    <div class="row">
        @include('admin.user._list', compact('usuarios'))
    </div>

@stop


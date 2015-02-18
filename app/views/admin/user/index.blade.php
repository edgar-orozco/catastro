@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('angular')
    ng-app="app" ng-controller="UserCtrl" ng-init="initApp()"
@stop

@section('content')
<div style="display: none" id="users">
    <div class="alert alert-success alert-dismissible" role="alert" ng-show="successSave">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Datos guardados</strong>, los datos del usuario se guardaron correctamente.
    </div>
    <div class="row">
        <div class="col-sm-6">
            <button class="btn btn-info" ng-click="openForm()" ng-hide="showForm" role="button">
              <span class="glyphicon glyphicon-plus"></span> Crear usuario
            </button>
        </div>
        <div class="col-sm-6">
            <div class="input-group" ng-hide="showForm">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search"></span>
                </span>
                {{Form::text('q', null, ['class'=>'form-control', 'placeholder'=>'Buscar por...', 'ng-model' => 'q'] )}}

                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{[{ filterName() }]} <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href ng-click="filterWord = 'name'">Nombre</a></li>
                        <li><a href ng-click="filterWord = 'apepat'">Apellido paterno</a></li>
                        <li><a href ng-click="filterWord = 'apemat'">Apellido materno</a></li>
                        <li class="divider"></li>
                        <li><a href ng-click="filterWord = 'email'">Email</a></li>
                        <li><a href ng-click="filterWord = 'user'">Usuario</a></li>
                        <li><a href ng-click="filterWord = 'rol'">Rol</a></li>
                        <li><a href ng-click="filterWord = 'municipio'">Municipio</a></li>
                    </ul>
                </div><!-- /btn-group -->
            </div><!-- /input-group -->
            <button type="button" class="btn btn-primary pull-right" ng-click="closeForm()" ng-show="showForm">
                <i class="glyphicon glyphicon-arrow-left"></i> Regresar
            </button>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <br>
    <div class="row">
        <div ng-class="showForm ? 'col-sm-4 col-md-4 col-lg-4 resize' : ''" ng-show="showForm">

            {{ Form::open(array('url' => 'admin/user', 'method' => 'POST', 'name' => 'formUser')) }}

            @include('admin.user._formAngular')

            <div class="form-actions form-group">
                <button disabled="disabled" class="btn btn-primary" ng-disabled="formUser.$invalid || checkPassword()" type="button" ng-click="store()">
                    {[{ user.id !== undefinied ? 'Modificar usuario' : 'Crear nuevo usuario' }]}
                </button>
                {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
            {{Form::close()}}

        </div>
        <div ng-class="showForm ? 'col-sm-8 col-md-8 col-lg-8' : 'col-sm-12 col-md-12 col-lg-12 resize'">
            @include('admin.user._listAngular')
        </div>
    </div>
</div>
@stop

@section('javascript')
    {{ HTML::script('js/plugins/dirPagination.js') }}
    {{ HTML::script('js/user/users.js') }}
    {{ HTML::script('js/laroute.js') }}
@stop

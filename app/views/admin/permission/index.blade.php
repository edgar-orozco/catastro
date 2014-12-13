@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('angular')
    ng-app="permissions" ng-controller="PermissionsCtrl"
@stop


@section('content')
    <div class="row">
            <button type="button" class="btn btn-info" ng-click="openForm()" ng-hide="showForm">
                <i class="glyphicon glyphicon-plus"></i> Crear Permiso
            </button>
            <button type="button" class="btn btn-primary pull-right" ng-click="closeForm()" ng-show="showForm">
                <i class="glyphicon glyphicon-arrow-left"></i> Regresar
            </button>
     </div>
    <div class="row">
        <div class="col-md-4 fadein fadeout" ng-show="showForm">

                {{ Form::open(array('url' => 'admin/permission', 'method' => 'POST', 'name' => 'formPermission')) }}

                    @include('admin.permission._form')

                    <div class="form-actions form-group">
                        <button disabled="disabled" class="btn btn-primary" ng-disabled="formPermission.$invalid || isInvalid()" type="button" ng-click="store()">
                            {[{ permission.id !== undefinied ? 'Editar permiso' : 'Crear nuevo permiso' }]}
                        </button>
                        {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
                    </div>
                {{Form::close()}}

        </div>
        <div ng-class="showForm ? 'col-sm-8 col-md-8 col-lg-8' : 'col-sm-12 col-md-12 col-lg-12'">
            @include('admin.permission._list', compact('permissions'))
        </div>
    </div>

@stop

@section('javascript')
    {{ HTML::script('js/permission/permission.js') }}
    {{ HTML::script('js/laroute.js') }}
@stop
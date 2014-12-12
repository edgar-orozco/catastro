@extends('layouts.default')

@section('content')

    <div class="row" ng-app="permissions" ng-controller="PermissionsCtrl">

        <div class="col-md-4">

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

        <div class="col-sm-8 col-md-8 col-lg-8">
            @include('admin.permission._list', compact('permissions'))
        </div>
</div>

@stop

@section('javascript')
    {{ HTML::script('js/permission/permission.js') }}
    {{ HTML::script('js/laroute.js') }}
@stop
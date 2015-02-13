@extends('layouts.default')

@section('content')

    <div class="row">

        <div class="col-md-4">
        <a href="{{URL::route('admin.requisitos.index')}}" class="btn btn-primary pull-right" role="button">
            <i class="glyphicon glyphicon-arrow-left"></i> Regresar
        </a>
        {{ Form::open(array('url' => 'catalogos/status', 'method' => 'POST', 'cve_status' => 'formPermission')) }}

            @include('catalogos.status._form')

            <div class="form-actions form-group">
                <button disabled="disabled" class="btn btn-primary" ng-disabled="formStatus.$invalid || isInvalid()" type="button" ng-click="store()">
                                            {[{ status.id_status !== undefinied ? 'Editar status' : 'Crear nuevo status' }]}
                </button>
              {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">
            @include('catalogos.status._list', compact('statuss'))<!--_list -->
        </div>
</div>

@stop

@section('javascript')
{{ HTML::script('js/catalogos/status.js') }}
{{ HTML::script('js/laroute.js') }}
@stop
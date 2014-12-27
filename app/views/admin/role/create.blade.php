@extends('layouts.default')

@section('content')

    <div class="row">
        <a href="{{URL::route('admin.role.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
        <div class="col-md-4">

        {{ Form::open(array('url' => 'admin/role', 'method' => 'POST')) }}

            @include('admin.role._form', compact('permissions'))

            <div class="form-actions form-group">
              {{ Form::submit('Crear nuevo rol', array('class' => 'btn btn-primary')) }}
              {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.role._list', compact('roles'))

        </div>
</div>

@stop
@extends('layouts.default')

@section('content')

    <div class="row">
        <a href="{{URL::route('admin.permission.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-md-4">

        {{ Form::open(array('url' => 'admin/permission', 'method' => 'POST')) }}

            @include('admin.permission._form')

            <div class="form-actions form-group">
              {{ Form::submit('Crear nuevo permiso', array('class' => 'btn btn-primary')) }}
              {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.permission._list', compact('permission'))

        </div>
</div>

@stop
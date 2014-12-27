@extends('layouts.default')

@section('content')

    <div class="row">
    <a href="{{URL::route('admin.requisitos.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-md-4">

        {{ Form::open(array('url' => 'admin/requisitos', 'method' => 'POST')) }}

            @include('admin.requisitos._form')

            <div class="form-actions form-group">
              {{ Form::submit('Crear nuevo requisito', array('class' => 'btn btn-primary')) }}
              {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.requisitos._list', compact('requisitos'))

        </div>
</div>

@stop
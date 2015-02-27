@extends('layouts.default')

@section('content')

<div class="row">
    <a href="{{URL::route('catalogos.ejecutores.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

    <div class="col-md-4">

        {{ Form ::open(array('url' => 'catalogos/ejecutores', 'method' => 'POST')) }}

        @include('catalogos.ejecutores._form')

        <div class="form-actions form-group">
            {{ Form::submit('Crear nuevo ejecutor', array('class' => 'btn btn-primary')) }} 
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::close()}}

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

        @include('catalogos.ejecutores._list', compact('ejecutoress'))<!--_list -->
    </div>
</div>

@stop
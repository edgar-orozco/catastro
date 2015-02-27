@extends('layouts.default')

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')

<div class="row">
    <a href="{{URL::route('catalogos.ejecutores.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

    <div class="col-md-4">

        {{ Form::model($ejecutores, ['route' => array('catalogos.ejecutores.update', $ejecutores->id_ejecutor ), 'method'=>'put' ]) }}
        
        @include('catalogos.ejecutores._form', compact('ejecutores'))

        <div class="form-actions form-group">
            {{ Form::submit('Modificar Ejecutores', array('class' => 'btn btn-primary')) }}
            {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::close()}}

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

        @include('catalogos.ejecutores._list', compact('ejecutoress'))

    </div>
</div>

@stop
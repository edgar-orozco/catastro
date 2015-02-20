@extends('layouts.default')

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')

<div class="row">
    <a href="{{URL::route('catalogos.salario.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

    <div class="col-md-4">

        {{ Form::model($salario, ['route' => array('catalogos.salario.update', $salario->id_salario_minimo ), 'method'=>'put' ]) }}
        
        @include('catalogos.salario._form', compact('salario'))

        <div class="form-actions form-group">
            {{ Form::submit('Modificar salario minimo', array('class' => 'btn btn-primary')) }}
            {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::close()}}

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

        @include('catalogos.salario._list', compact('salario'))

    </div>
</div>

@stop
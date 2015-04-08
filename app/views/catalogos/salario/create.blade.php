@extends('layouts.default')

@section('content')

    <div class="row">
    <a href="{{URL::route('catalogos.salario.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-md-4">
        
        {{ Form::open(array('id'=>'form','url' => 'catalogos/salario', 'method' => 'POST')) }}

            @include('catalogos.salario._form')

            <div class="form-actions form-group">
               {{ Form::submit('Crear nuevo salario minimo', array('class' => 'btn btn-primary','id'=>'sal')) }} 
               {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning','id'=>'reset']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">
            
            @include('catalogos.salario._list', compact('salarios'))<!--_list -->
        </div>
</div>

@stop

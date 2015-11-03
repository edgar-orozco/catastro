@extends('layouts.default')

@section('title')
    {{ $title }}::@parent
@stop

@section('content')
    <div class="row">
        {{ Form::open(array('url'=>'tramites/propietario/create','method'=>'POST','id'=>'id_p')) }}
        
        @include('tramites.propietario._form')
        
        <div class="form-actions form-group col-md-6" style="clear:both; ">
           {{ Form::submit('Crear Nuevo Propietario', array('class' => 'btn btn-primary', 'id'=>'btn-sumbit-manifestacion')) }}
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }} 
        </div>
        {{ Form::close() }}
    </div>
@stop


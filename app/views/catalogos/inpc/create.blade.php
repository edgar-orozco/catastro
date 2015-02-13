@extends('layouts.default')

@section('content')

    <div class="row">
    <a href="{{URL::route('catalogos.inpc.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-md-4">
        
        {{ Form::open(array('url' => 'catalogos/inpc', 'method' => 'POST')) }}

            @include('catalogos.inpc._form')

            <div class="form-actions form-group">
               {{ Form::submit('Crear nuevo INPC', array('class' => 'btn btn-primary')) }} 
               {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">
            
            @include('catalogos.inpc._list', compact('inpcs'))<!--_list -->
        </div>
</div>

@stop

@extends('layouts.default')

@section('content')
<div class="row">
    <a href="/ventanilla/notaria/" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-md-4">
        
        {{ Form::open(array('id'=>'form','url' => 'ventanilla/notaria', 'method' => 'POST')) }}

            @include('admin.notaria._form')

            <div class="form-actions form-group">
               {{ Form::submit('Crear nueva notaria', array('class' => 'btn btn-primary','tabindex'=>'15')) }} 
               {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">
            
            @include('admin.notaria._list', compact('Notarias'))<!--_list -->
        </div>
</div>
@stop
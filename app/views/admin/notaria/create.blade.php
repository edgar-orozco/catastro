@extends('layouts.default')

@section('content')
<div class="row">
    <a href="{{URL::route('admin.notaria.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

        <div class="col-sm-8 col-md-8 col-lg-8">
        
        {{ Form::open(array('id'=>'form','url' => 'admin/notaria', 'method' => 'POST')) }}

            @include('admin.notaria._form')

            <div class="form-actions form-group">
               {{ Form::submit('Crear nueva notaria', array('class' => 'btn btn-primary','tabindex'=>'15')) }} 
               {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

</div>
@stop
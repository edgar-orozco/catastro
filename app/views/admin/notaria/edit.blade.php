@extends('layouts.default')

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')

<div class="row">
    <a href="{{URL::route('admin.notaria.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
    
    <div class="col-sm-8 col-md-8 col-lg-8">
        {{ Form::model($Notaria, ['route' => array('admin.notaria.update', $Notaria->id_notaria ), 'method'=>'put' ]) }}
        
        @include('admin.notaria._form', compact('Notaria'))
        <div class="form-actions form-group">
            {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}
            <a href="{{URL::route('admin.notaria.index')}}" class="btn btn-warning" role="button"> Cancelar</a>
        </div>
        {{Form::close()}}
    </div>
    
</div>
@stop
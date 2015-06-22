@extends('layouts.default')

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')
<div class="row">
    <a href="" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
    <div class="col-md-4">
        
        
        @include('admin.notaria._form', compact('Notarias'))
        <div class="form-actions form-group">
            {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}
            
        </div>
        {{Form::close()}}
    </div>
    <div class="col-sm-8 col-md-8 col-lg-8">
        @include('admin.notaria._list', compact('Notarias'))
    </div>
</div>
@stop
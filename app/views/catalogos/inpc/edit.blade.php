@extends('layouts.default')

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')

<div class="row">
    <a href="{{URL::route('catalogos.inpc.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

    <div class="col-md-4">

        {{ Form::model($inpc, ['route' => array('catalogos.inpc.update', $inpc->id_inpc ), 'method'=>'put' ]) }}
        
        @include('catalogos.inpc._form', compact('inpc'))

        <div class="form-actions form-group">
            {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}
            <a href="{{URL::route('catalogos.inpc.index')}}" class="btn btn-warning" role="button"> Cancelar</a>
        </div>
        {{Form::close()}}

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

        @include('catalogos.inpc._list', compact('inpc'))

    </div>
</div>

@stop


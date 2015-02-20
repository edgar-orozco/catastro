@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

    <div class="row">
        <a href="{{URL::route('catalogos.status.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
        <div class="col-md-4">

            {{ Form::model($status, ['route' => array('catalogos.status.update', $status->id_status ), 'method'=>'put' ]) }}

                @include('catalogos.status._form', compact('status'))

                <div class="form-actions form-group">
                  {{ Form::submit('Modificar status', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
                </div>
            {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('catalogos.status._list', compact('statuss'))

        </div>
    </div>

@stop
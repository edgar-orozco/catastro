@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

    <div class="row">
        <a href="{{URL::route('admin.permission.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
        <div class="col-md-4">

            {{ Form::model($permission, ['route' => array('admin.permission.update', $permission->id ), 'method'=>'put' ]) }}

                @include('admin.permission._form', compact('permission'))

                <div class="form-actions form-group">
                  {{ Form::submit('Modificar permiso', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
                </div>
            {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.permission._list', compact('permissions'))

        </div>
    </div>

@stop


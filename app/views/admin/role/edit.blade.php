@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('menu')
    @include('admin.menu')
@append

@section('content')

    <div class="row">
        <a href="{{URL::route('admin.role.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
        <div class="col-md-4">

            {{ Form::model($role, ['route' => array('admin.role.update', $role->id ), 'method'=>'put' ]) }}
                @include('admin.role._form', compact('role'))

                <div class="form-actions form-group">
                  {{ Form::submit('Modificar rol', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
                </div>
            {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.role._list', compact('roles','role'))

        </div>
    </div>

@stop


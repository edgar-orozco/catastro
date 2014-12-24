@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('menu')
    @include('admin.menu')
@append

@section('content')

    <div class="row">
        <a href="{{URL::route('admin.user.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
        <div class="col-md-4">

            {{ Form::model($user, ['route' => array('admin.user.update', $user->id ), 'method'=>'put' ]) }}
                @include('admin.user._form', compact('user'))

                <div class="form-actions form-group">
                  {{ Form::submit('Modificar usuario', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
                </div>
            {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.user._list', compact('usuarios','user'))

        </div>
    </div>

@stop


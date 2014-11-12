@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')


    <div class="well">
        <div class="row">

            <div class="col-md-4">

                {{ Form::model($user, ['route' => array('admin.user.update', $user->id ), 'method'=>'put' ]) }}
                    @include('admin.user._form', compact('user'))
                {{Form::close()}}

            </div>

            <div class="col-sm-8 col-md-8 col-lg-8">

                @include('admin.user._list', compact('usuarios'))

            </div>
        </div>
    </div>

@stop


@extends('layouts.default')

@section('content')

    <div class="row">

        <div class="col-md-4">

        {{ Form::open(array('url' => 'admin/user', 'method' => 'POST')) }}

            @include('admin.user._form')

            <div class="form-actions form-group">
              {{ Form::submit('Crear nuevo usuario', array('class' => 'btn btn-primary')) }}
              {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.user._list', compact('usuarios'))

        </div>
</div>

@stop
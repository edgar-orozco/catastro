@extends('layouts.default')

@section('content')

    <div class="row">

        <div class="col-md-4">

        {{ Form::open(array('url' => 'admin/role', 'method' => 'POST')) }}

            @include('admin.role._form', compact('permissions'))

            <div class="form-actions form-group">
              {{ Form::submit('Crear nuevo rol', array('class' => 'btn btn-primary')) }}
              {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
            </div>
        {{Form::close()}}

        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">

            @include('admin.role._list', compact('roles'))

        </div>
</div>

@stop
@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{--{{ HTML::style('css/forms.css') }} --}}

    <div class="row">

        {{ Form::open(array('url' => 'ofvirtual/notario/manifestacion/create', 'method' => 'POST', 'id' => 'formManifestacion')) }}

        @include('ofvirtual.notario.manifestacion._form', [])

        <div class="form-actions form-group col-md-6" style="clear:both; ">
            {{ Form::submit('Crear nueva Manifestación Catastral', array('class' => 'btn btn-primary')) }}
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>

        {{Form::close()}}

    </div>


@stop

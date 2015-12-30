<!-- @extends('layouts.hooktramite') -->
@extends('layouts.default')

@section('content')

    {{--{{ HTML::style('css/forms.css') }} --}}

    <div class="row">

        {{ Form::open(array('url' => 'ofvirtual/notario/manifestacion/create', 'method' => 'POST', 'id' => 'formManifestacion')) }}

        @include('ofvirtual.notario.manifestacion._form', [])

        <div class="form-actions form-group col-md-6" style="clear:both; ">
            {{ Form::submit('Crear Nueva Manifestación Catastral', array('class' => 'btn btn-primary', 'id'=>'btn-sumbit-manifestacion')) }}
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::token() }}
        {{Form::close()}}

    </div>


@stop

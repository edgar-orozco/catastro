@extends('layouts.hooktramite')

@section('content')

    {{--{{ HTML::style('css/forms.css') }} --}}

    <div class="row">

        {{ Form::open(array('url' => 'ofvirtual/notario/manifestacion/stores', 'method' => 'GET', 'id' => 'formManifestacion')) }}
    {{ Form::hidden('clave', $clave, ['class' => 'form-control', 'id' => 'clave'] )}}
    {{ Form::hidden('cuenta', $cuenta, ['class' => 'form-control', 'id' => 'cuenta'] )}}
    {{ Form::hidden('tramite_id', $tramite_id, ['class' => 'form-control', 'id' => 'tramite_id'] )}}
        @include('ofvirtual.notario.manifestacion._form', [])
    
        <div class="form-actions form-group col-md-6" style="clear:both; ">
            {{ Form::submit('Crear Nueva Manifestación Catastral', array('class' => 'btn btn-primary', 'id'=>'btn-sumbit-manifestacion')) }}
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::token() }}
        {{Form::close()}}

    </div>


@stop

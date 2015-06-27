@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <h1>Traslado de dominios</h1>

    {{--{{ HTML::style('css/forms.css') }} --}}

        <div class="row">

            {{ Form::open(array('url' => 'ofvirtual/notario/traslado/create', 'method' => 'POST')) }}

                @include('ofvirtual.notario.traslado._form', compact('traslado'))

                <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
                  {{ Form::submit('Crear nuevo traslado de dominio', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
                </div>
            {{Form::close()}}

        </div>


</div>


@stop

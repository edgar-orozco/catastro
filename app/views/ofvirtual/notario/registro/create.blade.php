@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <h1>Registro de Escrituras</h1>

    {{--{{ HTML::style('css/forms.css') }} --}}

        <div class="row">

            {{ Form::open(array('url' => 'ofvirtual/notario/registro/create', 'method' => 'POST', 'id' => 'formRegistro')) }}

                @include('ofvirtual.notario.registro._form', compact('registro','notaria','vialidad','entidad','asentamiento','municipio','JsonColindancias'))

            <div class="form-actions form-group col-md-6" style="clear:both; ">
                  {{ Form::submit('Crear nuevo registro de escritura', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
                </div>

            {{Form::close()}}

        </div>


</div>


@stop

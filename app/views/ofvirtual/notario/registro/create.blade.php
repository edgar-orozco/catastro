@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <h1>Regitro de Escrituras</h1>

    {{--{{ HTML::style('css/forms.css') }} --}}

        <div class="row">

            {{ Form::open(array('url' => 'ofvirtual/notario/registro/create', 'method' => 'POST')) }}

                @include('ofvirtual.notario.registro._form', compact('registro','notaria'))


            {{Form::close()}}

        </div>


</div>


@stop

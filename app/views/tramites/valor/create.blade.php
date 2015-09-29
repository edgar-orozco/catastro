@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{--{{ HTML::style('css/forms.css') }} --}}

    <div class="row">

        {{ Form::open(array('url' => 'tramites/valor/create', 'method' => 'POST', 'id' => 'formValor')) }}

        @include('tramites.valor._form', [])

        {{Form::token() }}
        {{Form::close()}}

    </div>


@stop

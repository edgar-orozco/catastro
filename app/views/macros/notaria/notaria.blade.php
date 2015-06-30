@extends('layouts.default')

@section('title')
  {{{ $title }}} :: @parent
@stop

@section('javascript')


@append

@section('content')
  <div class="mensaje">
  </div>
  {{ Form::open(array('id' => 'formpersonas','url' => '/macro-guardar', 'method' => 'post')) }}
  <!-- datos solicitante -->
  <fieldset>
  <legend>Datos Notaría</legend>
  <div class="row">
        {{Form::notaria(1)}}
  </div><!-- /.row -->
  </fieldset>
  </br></br>

  {{ Form::close() }}


@stop
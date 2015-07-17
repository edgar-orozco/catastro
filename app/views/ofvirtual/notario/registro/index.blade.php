@extends('layouts.default')

@section('title')
  {{{ $title }}} :: @parent
@stop

@section('content')

<!-- municipios -->
  <div class="row">
        @include('ofvirtual.notario.registro.municipios', compact('municipios'))
  </div>



<!-- listado traslados -->
    <div class="row">
        @include('ofvirtual.notario.registro._list', compact('registros'))
    </div><!-- /.row -->


@stop
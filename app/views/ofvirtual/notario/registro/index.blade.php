@extends('layouts.default')

@section('title')
  {{{ $title }}} :: @parent
@stop

@section('content')

<!-- municipios -->
  <div class="row">
        @include('ofvirtual.notario.registro.municipios',compact('municipio'))
  </div>

 <!--buscador -->
  <div class="row">
      <div class="col-md-4 pull-right">
          @include('ofvirtual.notario.registro._form_buscador', compact('registros'))
      </div>
  </div><!-- /.row -->

<!-- listado traslados -->
    <div class="row">
        @include('ofvirtual.notario.registro._list', compact('registros'))
    </div><!-- /.row -->


@stop
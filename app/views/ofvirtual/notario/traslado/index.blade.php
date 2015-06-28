@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

<!-- municipios -->
  <div class="row">
        @include('ofvirtual.notario.traslado.municipios')
  </div>

  <!--buscador -->
  <div class="row">
      <div class="col-md-4 pull-right">
          @include('ofvirtual.notario.traslado._form_buscador', compact('traslados'))
      </div>
  </div><!-- /.row -->

<!-- listado traslados -->
    <div class="row">
        @include('ofvirtual.notario.traslado._list', compact('traslados'))
    </div><!-- /.row -->


@stop
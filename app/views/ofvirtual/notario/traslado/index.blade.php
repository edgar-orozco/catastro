@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')




{{ HTML::style('css/forms.css') }}

<!-- municipios -->
  <div class="row">
        @include('ofvirtual.notario.traslado.municipios')
    </div><!-- /.row -->

<!--buscador -->
  <div class="row">
        @include('ofvirtual.notario.traslado._form_buscador', compact('traslados'))
    </div><!-- /.row -->


<!-- listado traslados -->
    <div class="row">
        @include('ofvirtual.notario.traslado._list', compact('traslados'))
    </div><!-- /.row -->


@stop






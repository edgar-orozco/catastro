@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
<div class="row">
	<a href="{{URL::route('corevat.Empresas.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Regresar</a>
	<div class="col-md-4">
        {{ Form::open(array('id'=>'form','url' => 'corevat/Empresas/', 'method' => 'POST')) }}
		@include('CorevatCatalogos.Empresas._form')
		<div class="form-actions form-group">
			{{ Form::submit('Crear', array('class' => 'btn btn-primary')) }} 
			{{ Form::reset('Limpiar formulario', ['class' => 'btn btn-warning']) }}
		</div>
		{{Form::close()}}
	</div>
	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.Empresas._list', compact('Empresas'))
	</div>
</div>
@stop

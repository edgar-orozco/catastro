@extends('layouts.default')
@section('content')
<div class="row">
	<a href="{{URL::route('corevat.CatCimentaciones.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i>Regresar</a>
	<div class="col-md-4">
        {{ Form::open(array('id'=>'form','url' => 'corevat/CatCimentaciones/', 'method' => 'POST')) }}
		@include('CorevatCatalogos.CatCimentaciones._form')
		<div class="form-actions form-group">
			{{ Form::submit('Crear una nuevo registro', array('class' => 'btn btn-primary')) }} 
			{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
		</div>
		{{Form::close()}}
	</div>
	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.CatCimentaciones._list', compact('CatCimentaciones'))<!--_list -->
	</div>
</div>
@stop

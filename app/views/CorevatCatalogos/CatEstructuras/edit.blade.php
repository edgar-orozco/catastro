@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
<div class="row">
    <a href="{{URL::route('corevat.CatEstructuras.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i>Regresar</a>
	<div class="col-md-4">
		{{ Form::model($row, ['route' => array('corevat.CatEstructuras.update', $row->idestructura ), 'method'=>'put' ]) }}
		@include('CorevatCatalogos.CatEstructuras._form', compact('CatEstructuras'))
		<div class="form-actions form-group">
			{{ Form::submit('Modificar registro', array('class' => 'btn btn-primary')) }}
			<a href="{{URL::route('corevat.CatEstructuras.index')}}" class="btn btn-warning" role="button">Cancelar</a>
		</div>
		{{Form::close()}}
    </div>

	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.CatEstructuras._list', compact('CatEstructuras'))
	</div>
</div>
@stop

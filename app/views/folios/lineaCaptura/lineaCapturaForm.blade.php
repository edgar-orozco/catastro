@extends('layouts.default')

@section('styles')
@stop


@section('content')
	
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Formulario para linea de captura</h3>
    </div>
{{Form::open(['id' => 'WebService', 'target'=>'_blank'])}}
	<div class="panel-body ">
	       <div class="col-md-7"> 
		       	@if($errors->first('nombre'))
		       		Nombre {{$errors->first('nombre')}}<br>
		       	@endif
		        {{Form::label('nombre','Nombre:')}}
		        {{Form::text('nombre', null, ['class' => 'form-control'] )}}
	        </div>

	        <div class="col-md-7">
		        @if($errors->first('paterno'))
		       		Apellido Paterno {{$errors->first('paterno')}}<br>
		       	@endif
		        {{Form::label('paterno','Apellido Paterno:')}}
		        {{Form::text('paterno', null, ['class' => 'form-control'] )}}
	        </div>

	        <div class="col-md-7"> 
		        @if($errors->first('materno'))
		       		Apellido Materno {{$errors->first('materno')}}<br>
		       	@endif
		        {{Form::label('materno','Apellido Materno:')}}
		        {{Form::text('materno', null, ['class' => 'form-control'] )}}
	        </div>

	        <div class="col-md-7">
		        @if($errors->first('folios_urbanos'))
		       		Folios urbanos {{$errors->first('folios_urbanos')}}<br>
		       	@endif
	          	{{Form::label('folios_urbanos','Cantidad folios Urbanos:')}}
	      		{{Form::text('folios_urbanos', null, ['class' => 'form-control'] )}}
	        </div>
	        <div class="col-md-7">
		        @if($errors->first('folios_rusticos'))
		       		Folios Rusticos {{$errors->first('folios_rusticos')}}<br>
		       	@endif
	        	{{Form::label('folios_rusticos','Cantidad Folios Rusticos:')}}
	          	{{Form::text('folios_rusticos', null, ['class' => 'form-control'] )}}
	        </div>


	</div>
	{{Form::submit('Guardar',['class'=>'btn btn-primary btn-lg col-md-3 col-md-offset-4', 'href' =>'_blank'])}}
{{Form::close()}}
</div>
@stop


@section('javascript')
@stop

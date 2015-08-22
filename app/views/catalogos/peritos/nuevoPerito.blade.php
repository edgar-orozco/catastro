@extends('catalogos.peritos.editPerito')



@section('titulo2')
Nuevo Perito
@stop

 
@section('corevat')

{{ Form::textarea('corevat', 'COREVAT-'.$nuevoCorevat,  array('cols'=>'60', 'rows'=>'1', 'required' => ''), ['class'=>'form-control'])}} 
{{$errors->first("corevat")}}
@stop


@section('nombre')
{{ Form::textarea('nombre', null, array('cols'=>'60', 'rows'=>'1','required'=>''), ['class'=>'form-control'])}} 
{{ Form::hidden('status', 'Habilitado') }}
{{$errors->first("nombre")}}
@stop


@section('direccion')
{{ Form::textarea('direccion', '', array('cols'=>'60', 'rows'=>'3', 'required' => ''), ['class'=>'form-control'])}} 
{{$errors->first("direccion")}}
@stop


@section('telefono')
{{ Form::textarea('telefono', null, array('cols'=>'60', 'rows'=>'3','required'=>''), ['class'=>'form-control'])}} 
{{$errors->first("telefono")}}
@stop


@section('correo')
{{ Form::textarea('correo', '', array('cols'=>'60', 'rows'=>'2', 'required'=>'required'), ['class'=>'form-control'])}} 
{{$errors->first("correo")}}
@stop


@section('boton')
<input class="btn btn-primary" type="submit" value="Guardar">

@stop

					
@extends('layouts.default')

@section('title')
{{$title}}::@parent
@stop

@section('content')
<div class="col-md-4">
{{Form::label('BUSCAR GESTIÓN CATASTRAL PARA EDITAR')}}
    <div class="form-group">
        {{Form::text('clave', null, ['id'=>'id'] )}}
        <a id="buscar" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
    </div>
{{Form::close()}}
</div>
<div class="col-sm-12 col-md-12 col-lg-12" id="mainForm">
    {{Form::open(array('id'=>'form','url'=>'kiosko/solicitud','method'=>'POST'))}}
        @include('kiosko.solicitud._form')
        <div class="form-actions form-group">
            {{Form::submit('Crear nueva solicitud',array('class' => 'btn btn-primary','tabindex'=>'13'))}}
            {{Form::reset('Limpiar formato', ['class' => 'btn btn-warning','tabindex'=>'14'])}}
        </div>
    {{Form::close()}}
</div>    
@stop
@section('javascript')
<script>
  $(document).ready(function(){
      $('#buscar').on('click',function(){
          
        $.get('/kiosko/solicitud/edit/'+$('#id').val(), function(data)
        {
            $("#mainForm").html("");
            $("#mainForm").html(data);
        });
          
      });
      
  });    
</script>
@append


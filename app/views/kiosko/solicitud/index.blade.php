@extends('layouts.default')

@section('title')
{{$title}}::@parent
@stop

@section('content')
 <div class="col-md-4">
    {{Form::label('BUSCAR GESTIÓN CATASTRAL PARA EDITAR')}}
        <div class="form-group">
        {{Form::open(array('id'=>'form2','url'=>'kiosko/solicitud/edit/','method'=>'GET'))}}
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
    
    
// $('#form').bind('submit', function ()
//    {
//        $.ajax(
//                {
//                    type: 'POST',
//                    data: new FormData(this), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
//                    processData: false,
//                    contentType: false,
//                    url: '/kiosko/store',
//                    success: function (data)
//                    {
//                        if(data){
//                            $('#hola').html('<div class="alert alert-danger">La clave o cuenta no existe</div>');
//                        }else{$('#hola').html('<div class="alert alert-danger">La clave </div>');}
//                        
//                    }
//                });
//        return false;
//    });
    
    
    
</script>
@append


{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop
@extends('layouts.default')

@section('title')
{{$title}}::@parent
@stop

@section('content')
<div class="col-md-4">
{{Form::label('BUSCAR GESTIÓN CATASTRAL PARA EDITAR')}}
    <div class="form-group">
        {{Form::text('clave', null, ['id'=>'id','placeholder'=>'N° de Solicitud'] )}}
        <a id="buscar" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-search"></span></a>
    </div>
</div>
<div class="col-sm-12 col-md-12 col-lg-12" id="mainForm">
    {{Form::open(array('id'=>'form','url'=>'kiosko/solicitud','method'=>'POST'))}}
        @include('kiosko.solicitud._form')
        <div class="form-actions form-group">
            {{Form::submit('Crear nueva solicitud',array('class' => 'btn btn-primary', 'tabindex'=>'13', 'data-toggle'=>'modal', 'data-target'=>'#myModal'))}}
            {{Form::reset('Limpiar formato', ['class' => 'btn btn-warning','tabindex'=>'14'])}}
        </div>
    {{Form::close()}}
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva Solicitud</h4>
            </div>
            <div class="modal-body" id="modalBody">
                <!--Aqui se carga el PDF en la pantalla modal-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
{{ HTML::script('js/jquery/jquery.validate.min.js') }}
<script>
  $(document).ready(function(){
      //para buscar los datos con la referencia
      $('#buscar').on('click',function(){
         window.location.assign('/kiosko/solicitud/edit/'+$('#id').val())
      });
      //para tener el pdf en un modal cuando guarda
      var form = $('#form');
      form.bind('submit',function (){
          $.ajax({
              type: form.attr('method'),
              data: new FormData(this),
              processData: false,
              contentType: false,
              url: form.attr('url'),
              beforeSend: function(){
                  //alert("sii"),
                  $('.modal-body').html('Cargando PDF... <span class="glyphicon glyphicon-refresh spin"></span>');
              },
              success: function(data){
                  //alert("muy bien"),
                  $('#modalBody').html('<object data="/kiosko/solicitud_pdf/'+data+'"type="application/pdf" width="100%" height="500"></object>')
                  document.getElementById("form").reset();
              },
              error: function(){
                  //alert("mmmmmm... bueno"),
                $('.modal-body').html('<div class="alert alert-danger"><ul id="errores">Error al guardar, verifique los datos</ul></div>');
              }     
          });
      return false;        
      });
  }); 
  //autocompletar  
  $(function () {
        $("#curp").autocomplete({
            source: "/kiosko/autocomplete",
            minLength: 18,
            select: function (event, ui) {
                $('#response').val(ui.item.id);
                $('#nombres').val(ui.item.nombres);
                $('#apellido_paterno').val(ui.item.apellido_paterno);
                $('#apellido_materno').val(ui.item.apellido_materno);
                $('#rfc').val(ui.item.rfc);
                $('#tipo_telefono').val(ui.item.tipo_telefono);
                $('#telefono').val(ui.item.telefono);
                $('#correo').val(ui.item.correo);
                $('#direccion').val(ui.item.direccion);
            }
        });
    });
</script>
@append
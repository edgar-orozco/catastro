@extends('layouts.default')

@section('content')
<!--(nombre campo, valor, arreglo[id,clase,])-->
{{ HTML::style('css/forms.css') }}
<div class="page-header">
    <h2>Generador de Folios <small>Datos del Folio</small></h2>
</div>
<div class="panel panel-primary">
    <div id="respuesta" hidden>
        <div class="alert alert-danger">
            <ul id="errores"></ul>
        </div>
    </div>

    {{Form::open(['id'=>'form'])}}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('folio_catastro','Numero de Oficio')}}
                {{Form::text('folio_catastro','', ['class'=>'form-control'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('perito_id','Perito')}}
                <select id="perito_id" name="perito_id" class="form-control">
                    @foreach($peritos as $perito)
                        <option value="{{$perito->id}}">{{$perito->corevat." -- ".$perito->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('cantidad_urbanos','Folios Urbanos')}}
                {{Form::text('cantidad_urbanos','', ['class'=>'form-control'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('cantidad_rusticos','Folios Rusticos')}}
                {{Form::text('cantidad_rusticos','',['class'=>'form-control'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('fecha_solicitud','Fecha de Solicitud')}}
                {{Form::input('date', 'fecha_solicitud', null, array('required', 'class'=>'fecha form-control' ))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('fecha_oficio','Fecha de Oficio')}}
                {{Form::input('date', 'fecha_oficio', null, array('required', 'class'=>'fecha form-control' ))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('no_recibo','Numero de Recibo')}}
                {{Form::text('no_recibo',null,['class'=>'form-control'])}}
            </div>
        </div>
        <div class="col-md-12">
            {{Form::submit('Guardar', ['class'=>'btn btn-success', 'data-toggle'=>'modal', 'data-target'=>'#myModal'])}}
            {{Form::close()}}
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body" id="modalBody">

      <!--Aqui se carga el PDF en la pantalla modal-->

      </div>

    </div>
  </div>
</div>


@stop

@section('javascript')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function()
{

	var form = $('#form');
	form.bind('submit',function ()
	{
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/nfolios',
            beforeSend: function()
            {
                 $('.modal-body').html('Cargando PDF... <span class="glyphicon glyphicon-refresh spin"></span>');
            },
            success: function (data)
            {


            	$('#modalBody').html(' <object data="/nfolios/formato/'+data.id+'" type="application/pdf" width="100%" height="700"></object>')
            }
        });
            return false;
	});





});

</script>

@stop
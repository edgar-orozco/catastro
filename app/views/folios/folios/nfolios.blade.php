@extends('layouts.default')


@section('content')
<!--(nombre campo, valor, arreglo[id,clase,])-->
{{ HTML::style('css/forms.css') }}
{{ HTML::style('js/jquery/jquery-ui.css') }}

<div class="page-header">
    <h3>Generador de Folios</h3>
    <h4>Datos del Folio</h4>
</div>
    @if(Session::has('errors'))
        <div class="alert alert-danger">
            @if(is_array(Session::get('errors')->All()))
                @foreach(Session::get('errors')->All() as $error )
                    <h4><span class="glyphicon glyphicon-remove"></span>  {{ $error }}</h4>
                @endforeach
            @else
                <h4><span class="glyphicon glyphicon-remove"></span>  {{ Session::get('errors') }}</h4>
            @endif
        </div>
    @endif
<div class="panel panel-default">
    <div id="respuesta" hidden>
        <div class="alert alert-danger">
            <ul id="errores"></ul>
        </div>
    </div>

    {{Form::open(['id'=>'form'])}} 

    <div class="row">
        <br/>
        <div class="col-md-6">
            <div class="form-group">

                {{Form::label('numero_oficio','Número de Oficio')}}
                {{Form::text('numero_oficio','', ['class'=>'form-control', 'maxlength'=>'8'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('perito_id','Perito')}}
                <select id="perito_id" name="perito_id" class="form-control">
                <option value="" selected="selected"> -- Seleccione el perito --</option>


                    @foreach($peritos as $perito)
                        <option value="{{$perito->id}}">{{$perito->corevat." -- ".$perito->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br/>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('cantidad_urbanos','Cantidad Folios Urbanos')}}
                {{Form::text('cantidad_urbanos','', ['class'=>'form-control', 'maxlength'=>'3'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('cantidad_rusticos','Cantidad Folios Rústicos')}}
                {{Form::text('cantidad_rusticos','',['class'=>'form-control', 'maxlength'=>'3'])}}
            </div>
        </div>
        <br/>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('fecha_solicitud','Fecha de Solicitud')}}
                {{Form::input('text', 'fecha_solicitud', null, array('required', 'class'=>'fecha form-control dateFolios', 'readonly', 'style' => 'background:white;' ))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('fecha_oficio','Fecha de Oficio')}}
                {{Form::input('text', 'fecha_oficio', null, array('required', 'class'=>'fecha form-control dateFolios', 'readonly', 'style' => 'background:white;'))}}
            </div>
        </div>
        <br/>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('no_recibo','Numero de Recibo')}}
                {{Form::text('no_recibo',null,['class'=>'form-control'])}}
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                {{Form::button('Limpiar Formulario', ['class'=>'btn btn-primary form-control', 'id' => 'limpiar_form'])}}
            </div>
            <div class="col-md-6 col-sm-6">
                {{Form::submit('Guardar', ['class'=>'btn btn-warning form-control', 'href' => '_blank'])}}
                {{Form::close()}}
            </div>
        </div>
        <br/>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body" id="modalBody">

      <!--Aqui se carga el PDF en la pantalla modal-->

      </div>

    </div>
  </div>
</div>



@stop

@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}

<script type="text/javascript">

	$(document).ready(function()
{
    $('#limpiar_form').on('click', function()
        {
            document.getElementById("form").reset();
        });

	var form = $('#forms');
	form.bind('submit',function ()
	{
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/nfolios',
            async: false,
            beforeSend: function()
            {
                 $('.modal-body').html('Cargando PDF... <span class="glyphicon glyphicon-refresh spin"></span>');
            },
            success: function (data)
            {


            	$('#modalBody').html(' <object data="/nfolios/formato/'+data.id+'" type="application/pdf" width="100%" height="700"></object>')
                document.getElementById("form").reset();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                if (textStatus === 'aborted') 
                {

                    alert('Ajax request aborted.');

                } else
                {
                    $('.modal-body').html('<div class="alert alert-danger"><ul id="errores">Error al guardar, verifique los datos. '+jqXHR+' '+textStatus+' '+errorThrown+' </ul></div>');
                }
            }
        });
            return false;
	});



$(function() {
    $( ".dateFolios" ).datepicker(
    {
        dateFormat: "dd-mm-yy"
    });

    $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
  });

});



</script>


@stop
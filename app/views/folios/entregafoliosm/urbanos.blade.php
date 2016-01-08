@extends('layouts.default')


 @section('styles')
    .spinner 
    {
        position: fixed;
        top: 50%;
        left: 50%;
        margin-left: -50px; /* half width of the spinner gif */
        margin-top: -50px; /* half height of the spinner gif */
        text-align:center;
        z-index:1234;
        overflow: auto;
        width: 100px; /* width of the spinner gif */
        height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
    }
@stop

@section('content')



<h1></h1>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">FOLIOS URBANOS AUTORIZADOS PARA</h4>
    </div>

    <div class="panel-body">
        {{Form::open(['id' => 'foliosMR', 'method' => 'GET'])}}
        {{Form::select('year', $selectYear, null,  ['id' => 'year', 'class' => 'form-control input-sm', 'aria-controls' => 'emitidos-table'])}}
        {{Form::select('estadoF', ['x'=>'-- Seleccione estado de Folio --', '0'=>'Vigente', '1'=>'Usado'], 'x',  ['id' => 'estadoF', 'class' => 'form-control input-sm', 'aria-controls' => 'emitidos-table'])}}
        {{Form::close()}}
            <div class="row">
                <div class="col-md-3">
                    <label>COREVAT</label>
                    <h5>{{$perito->corevat}}</h5>
                </div>
                <div class="col-md-3">
                    <label>NOMBRE</label>
                    <h5>{{$perito->nombre}}</h5>                
                </div>
            </div>
            <div class="row">
            <div class="col-md-2">
                    <label>Buscar {{Form::Text('Busqueda', null, ['id'=>'searchField', 'class' => 'form-control input-sm', 'aria-controls' => 'emitidos-table'])}}</label>
                                    
            </div>
                
            </div>
            {{Form::open(['id' => 'formFolios'])}}
            <div id="tablaAjax">
                @include('folios.entregafoliosm.tablaAjaxU')
            </div>
            <div id ="ajaxloading" class="spinner" style="display:none;">
                <img id="img-spinner" src="/css/images/folios/spinner.gif" alt="Loading" width="70%" height="70%" />
                Cargando...
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    {{Form::submit('Guardar', ['class'=>'btn btn-block btn-success', 'id'=>'guardarFolio' ])}}
                    {{Form::close()}}
                </div>
            </div>
    </div>
</div>

	@stop

	@section('javascript')

	<script type="text/javascript">
	$(document).ready(function()
    {

		$('#year').on('change', function()
			{
				$( "#foliosMR" ).submit();
			});

		$("#todos").change(function(){

			if($(this).is(':checked')){

				$(".checkbox").prop('checked', 'checked');

			} else {

				$(".checkbox").attr('checked', false);				

			}

		});

		$('body').delegate('.checkbox', 'click', function(event) {

			if(!confirm("¿Está seguro de marcar el folio " + $(this).val() + "? Verifique el año del folio.")){

				return false;

			}

		});



	});
    var $loading = $('#ajaxloading').hide();
    $(document)
      .ajaxStart(function () {
        $loading.show();
      })
      .ajaxStop(function () {
        $loading.hide();
      });


    $('#searchField').bind('input keyup', function()
    {
        var $this = $(this);
        var delay = 1500; // 2 seconds delay after last input

        clearTimeout($this.data('timer'));
        $this.data('timer', setTimeout(function()
        {
            $this.removeData('timer');
            
            $.get('/entregafoliosmunicipal/tablaAjax/buscar', { buscar: $('#searchField').val(), id: getPath(3), tipo_folio: 'U' }, function(data) 
            {
                $('#tablaAjax').html(data);
            });

        }, delay));
    });

    $('#guardarFolio').on('click', function(e)
    {
        e.preventDefault();
        $.post($(location).attr('pathname'), $( "#formFolios" ).serialize() + "&tipo_folio=U", function(data) 
                {
                    $('#tablaAjax').html(data);
                }); 
            
    });

            

    $(document).on('click', '.pagination a', function(e)
    {
        e.preventDefault();
        count = 0;
        page = $(this).attr('href').split('page=')[1];
        href = $(location).attr('href');
        id = href.split('/')[5].split('?')[0];
        year = href.split('/')[5].split('?')[1].split('=')[1];
        console.log(year);

        $('.checkbox').each(function() 
        { //loop through each checkbox
                if(this.checked)
                {
                    count = count +1;
                }  //select all checkboxes with class "checkbox1"              
        });

        if (count>0)
        {
            alert("Hay " + count + " folios marcados, por favor guarde cambios antes de cambiar de pagina");
            return false;
        }

        $.get('/entregafoliosmunicipal/tablaAjax/?page='+page+'&id='+ id + '&tipo_folio=U'+'&year='+ year, function(data)
        {
            $('#tablaAjax').html(data);
        });

    });

    function getPath(numArray)
    {
        href =$(location).attr('pathname');
        href = href.split('/');
        path = href[numArray];
        return path;
    }

	</script>

	@stop
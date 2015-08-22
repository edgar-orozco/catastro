@extends('layouts.default')

   <!--Agrego para el datatable-->
    {{ HTML::style('/css/bootstrap.min.css') }}
    {{ HTML::style('/css/dataTables.bootstrap.css') }}

@section('styles')

    .error{
        color: red;
    }
    .ajaxSpinner{
    	font: normal 20px arial;
    }


@stop


@section('content')

	<div class="page-header">
	    <h3>Catalogo de Peritos</h3>
	</div>
	<div class="row" style="background: #ECECEC;">
		<div class="btn-beside-title col-md-2 col-md-offset-10">
		    <a href="/catalogos/peritos/nuevoPerito" class="btn btn-primary nuevo"   title="Nuevo Perito">
	        <span class="glyphicon glyphicon-plus-sign"></span>
	            Nuevo Perito
	        </a>
	    </div>
	</div>
	<br/>
	<br/>
	
	{{Form::open(['id'=>'peritoForm', 'method'=>'POST', 'action'=>'folios_PeritosController@post_nuevoPerito'])}}
		<div class="ajaxSpinner">
				Cargando ventana... <span class="glyphicon glyphicon-refresh spin"></span>
		</div>
		<div class="ajaxForm">
			@include('catalogos.peritos.tablaperitos')
		</div>

	{{Form::close()}}
@stop


@section('javascript')

{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js')}}
{{ HTML::script('/js/jquery/jquery.validate.min.js')}}



<script type="text/javascript">



	$(document).ready(function()
	{
		$( "#peritoForm" ).validate();
		$('#example').dataTable( 
		{
	        "language": 
	        {
	            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
	            "zeroRecords": "No se encontraron registros",
	            "info": "Mostrando pagina _PAGE_ de _PAGES_",
	            "infoEmpty": "No hay registros","search": "Filter records:",
	            "search": "Buscar:",
	            "infoFiltered": "(Filtrado en _MAX_ total de registros)",
	            "oPaginate": 
	            {
			      "sPrevious": "Anterior",
			      "sNext": "Siguiente"
			    }
	        }
    	});
		

	 	$("body").delegate('.habilitar', 'click', function()
	 	{
	    	if(!confirm("¿Seguro que quiere deshabilitar este perito?"))
	    	{
	    		return false;
	    	}
	    });
	    $("body").delegate('.deshabilitar', 'click', function()
	    {
	    	if(!confirm("¿Seguro que quiere habilitar este perito?"))
	    	{
	    		return false;
	    	}

		});

	  

	    $("body").delegate('.nuevo', 'click', function()
	    {
			
			$.get( $(this).attr('href'), function( data ) 
			{
		 		$( ".panel" ).html( data );
		 		$('.nuevo').attr('href', '/catalogos/peritos/index');
		 		$('.nuevo').html('Atras');
		 		$('.nuevo').attr('class', $('.nuevo').attr('class')+'atras');
		 		$('.alert-success').hide();
			});
			

			return false;

		});

		$("body").delegate('.editar', 'click', function()
	    {
			
			$.get( $(this).attr('href'), function( data ) 
			{
		 		$( ".panel" ).html( data );
		 		$('.nuevo').attr('href', '/catalogos/peritos/index');
		 		$('.nuevo').html('Atras');
		 		$('.nuevo').attr('class', $('.nuevo').attr('class')+'atras');
		 		$('.alert-success').hide();
			});
			

			return false;

		});

		


});

var $loading = $('.ajaxSpinner').hide();
$(document).ajaxStart(function ()
{
    $('.ajaxForm').hide();
    $loading.show();

})
.ajaxStop(function () {
	$loading.hide();
	$('.ajaxForm').show();
});

</script>

{{ HTML::script('/js/registro_escritura/validacion_esp.js')}}
@stop
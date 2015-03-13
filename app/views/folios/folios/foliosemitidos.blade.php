@extends('layouts.default')

@section('styleRef')

   <!--Agrego para el datatable-->
    {{ HTML::style('/css/bootstrap.min.css') }}
    {{ HTML::style('/css/dataTables.bootstrap.css') }}

@stop

@section('content')

<h1>Informe de Folios Emitidos</h1>

<div class="panel panel-primary">

	<div class="panel-heading">

		<h4 class="panel-title">Tabla de Folios Emitidos</h4>

	</div>

	<div class="panel-body">


	<table class="table datatable" id="example">
			<thead>
				<tr>
					<th>No. Oficio</th>
					<th>Corevat No.</th>
					<th>Perito</th>
					<th>Fecha de Oficio</th>
					<th>Folios Urbanos</th>
					<th>Folios Rusticos</th>
					<th>Usuario</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($femitidos as $folios)

			<?php

			$fechaBD=date_parse($folios->fecha_oficio);
			$fecha = array();

				$fecha['1'] = "Enero";
				$fecha['2'] = "Febrero";
				$fecha['3'] = "Marzo";
				$fecha['4'] = "Abril";
				$fecha['5'] = "Mayo";
				$fecha['6'] = "Junio";
				$fecha['7'] = "Julio";
				$fecha['8'] = "Agosto";
				$fecha['9'] = "Septiembre";
				$fecha['10'] = "Octubre";
				$fecha['11'] = "Noviembre";
				$fecha['12'] = "Diciembre";
				?>

				<tr>
				<?php $datos_perito = Perito::where('id', $folios->perito_id)->first();?>

					<td align="center">{{$folios->no_oficio}}</td>
					<td align="center">{{$datos_perito->corevat}}</td>
					<td align="center">{{$datos_perito->nombre}}</td>
					<td align="center">{{$fechaBD['day']. " de " . $fecha[$fechaBD['month']]}}</td>
					<td align="center">{{$folios->cantidad_urbanos}}</td>
					<td align="center">{{$folios->cantidad_rusticos}}</td>
					<td align="center">{{$folios->id_usuario}}</td>
					<td align="center"><a href="formato/{{$folios->id}}" data-toggle="modal" data-target="#myModal" class="reimprimir btn btn-xs btn-info" title="Reimprimir"><i class="glyphicon glyphicon-print"></i></a>
					<a href="eliminarFolio/{{$folios->no_oficio}}" class="eliminar" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>

				</tr>
				@endforeach


			</tbody>
			
		</table>

	</div>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body" id="modalBody">

      </div>
      <div class="modal-footer" id="modal-footer">
        
      </div>
    </div>
  </div>
</div>

	@stop

@section('javascript')

{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js')}}

	<script type="text/javascript">

	$(document).ready(function(){

		$('#example').dataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros","search": "Filter records:",
            "search": "Buscar:",
            "infoFiltered": "(Filtrado en _MAX_ total de registros)",
            "oPaginate": {
		      "sPrevious": "Anterior",
		      "sNext": "Siguiente"
		    }
        }
    } );

		$('body').delegate('.eliminar', 'click', function(event) {

			var href = $(this).attr('href');
			
			$('#modalBody').html('¿Esta seguro de eliminar esta emisión?');
			$('#modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" href="/www.google.com" class="btn btn-primary">Eliminar</button>');	
			$('#myModal').modal('toggle');
			return false;

		});


		$('body').delegate('.reimprimir', 'click', function(event) {


			var href = $(this).attr('href');
			
			$('#modalBody').html(' <object data="'+href+'" type="application/pdf" width="100%" height="705"></object>')
			$('#modal-footer').html('');
			$('#myModal').modal('toggle');
			

			return false;

		});

	});




	</script>

@stop
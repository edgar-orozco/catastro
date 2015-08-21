@extends('layouts.default')

   <!--Agrego para el datatable-->
    {{ HTML::style('/css/bootstrap.min.css') }}
    {{ HTML::style('/css/dataTables.bootstrap.css') }}




@section('content')


<div class="page-header">
    <h3>Catalogo de Peritos</h3>
</div>
<div class="row" style="background: #ECECEC;">
    <a href="/catalogos/peritos/nuevoPerito" class="btn btn-primary nuevo"  title="Nuevo Perito">Nuevo Perito</a>
</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Tabla de Peritos</h4>
	</div>
	<div class="panel-body">
        <br/>
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable example" id="example">
			<thead>
				<tr>
					<th>Corevat</th>
					<th>Perito</th>
					<th>Direccion</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($variableperito as $datosperitos)
				<tr>
					<td>{{$datosperitos->corevat}}</td>
					<td>{{$datosperitos->nombre}}</td>
					<td>{{$datosperitos->direccion}} </td>
					<td>
						<a href="actPerito/{{$datosperitos->id}}" class="btn btn-xs btn-info nuevo" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						@if($datosperitos->Estado == "1" )
							<a class="habilitar btn btn-xs btn-success" id="habilitar" href="estado/{{$datosperitos->id}}" title="Deshabilitar"><i class="glyphicon glyphicon-ok"></i></a>
						@else
							<a class="deshabilitar btn btn-xs btn-danger" id="deshabilitar" href="estado/{{$datosperitos->id}}" title="Habilitar"><i class="glyphicon glyphicon-remove"></i></a>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
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
		

	 $("body").delegate('.habilitar', 'click', function(){
	    	if(!confirm("¿Seguro que quiere deshabilitar este perito?")){
	    		return false;
	    	}
	    });
	    $("body").delegate('.deshabilitar', 'click', function(){
	    	if(!confirm("¿Seguro que quiere habilitar este perito?")){
	    		return false;
	    	}

	});

	  

	     $("body").delegate('.nuevo', 'click', function(){

	    	var href = $(this).attr('href');
			
			$('#modalBody').html(' <object data="'+href+'" type="application/pdf" width="100%" height="705"></object>')
			$('#modal-footer').html('');
			$('#myModal').modal('toggle');
			

			return false;

	});



});

	</script>
@stop
@extends('layouts.default')

<!--Agrego para el datatable-->
    {{ HTML::style('/css/bootstrap.min.css') }}
    {{ HTML::style('/css/dataTables.bootstrap.css') }}

@section('styleRef')


@stop

@section('content')

<div class="page-header">
    <h3>Todos los peritos</h3>
</div>

<div class="panel panel-default">

	<div class="panel-heading">

		<h4 class="panel-title">Tabla de Peritos</h4>

	</div>

	<div class="panel-body">
        <br/>
		<table class="table datatable table-striped" id="example">
			<thead>
				<tr>
					<th>Corevat</th>
					<th>Perito</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($variableperito as $aliasperitos)
				<tr>
					<td>{{$aliasperitos->corevat}}</td>
					<td>{{$aliasperitos->nombre}}</td>
					<td>
						
						<a href="/entregafoliose/detalles/{{$aliasperitos->id}}" class="btn btn-xs btn-info" title="Detalles"><i class="glyphicon glyphicon-info-sign" ></i></a>
						<a href="/entregafoliose/urbanos/{{$aliasperitos->id}}" class="btn btn-xs btn-success" title="Folios Urbanos">U</a>
						<a href="/entregafoliose/rusticos/{{$aliasperitos->id}}" class="btn btn-xs btn-success" title="Folios Rústicos">R</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
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
	});


	</script>

	@stop
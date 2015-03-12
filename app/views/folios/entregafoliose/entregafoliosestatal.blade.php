@extends('layouts.default')

@section('content')

<h1>Todos los peritos</h1>

<div class="panel panel-primary">

	<div class="panel-heading">

		<h4 class="panel-title">Tabla de Peritos</h4>

	</div>

	<div class="panel-body">

		<table class="table datatable" id="example">
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
						
						<a href="/entregafoliose/detalles/{{$aliasperitos->id}}" class="btn btn-xs btn-info" title="Detalles"><i class="fa fa-info-circle"></i></a>
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
	{{ HTML::script('//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js')}}
	{{ HTML::script('js/jquery/jquery.dataTables.js') }}
	{{ HTML::script('js/jquery/dataTables.bootstrap.js') }}
	<script type="text/javascript">
	$(document).ready(function(){
		$('#example').dataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros ","search": "Filter records:",
            "search": "Buscar:",
            "infoFiltered": "(Filtrado en _MAX_ total de registros)"
        }
    } );
	});


	</script>

	@stop
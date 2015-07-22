@extends('layouts.default')

@section('styles')
.customSize{
	width: 100px !important;
}
@stop

@section('content')

<div id="get_ajax">

	<table class="table datatable">
		<thead>
			<tr>
				<th>Municipio</th>
				<th>Rusticos entregados</th>
				<th>Urbanos entregados</th>
				<th>Ingreso Total</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($municipios as $municipio)
				<tr>
					<td>{{$municipio->municipio}}</td>
					<td>{{$municipio->rusticos}}</td>
					<td>{{$municipio->urbanos}}</td>
					<td>$ {{number_format($municipio->total, 2)}}</td>
					<td><a href="/reporte/municipio/{{$municipio->gid_mun}}" class="btn btn-xs btn-info infoP" title="Detalles"><i class="glyphicon glyphicon-list-alt"></i></a>
				</tr>
			@endforeach
		</tbody>
	</table>
		
</div>
@stop

@section('javascript')
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.infoP').bind('click', function()
		{
			$.get($(this).attr('href'), function(data)
			{
				$('#get_ajax').html(data);
			});
			return false
		});
	});
</script>
@stop
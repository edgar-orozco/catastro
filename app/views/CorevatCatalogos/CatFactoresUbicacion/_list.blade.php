<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">{{$titleGrid}}</h3>
	</div>
	@if(count($rows) == 0)
	<div class="panel-body">
		<p>No hay requisitos dados de alta actualmente en el sistema.</p>
	</div>
	@endif
	<div class="list-group">
		<table class="table">
			<thead>
				<tr>
					<th rowspan="2">Descripción</th>
					<th colspan="2">Rango</th>
					<th rowspan="2">Estatus</th>
					<th rowspan="2">Acciones</th>
				</tr>
				<tr>
					<th>Mínimo</th>
					<th>Máximo</th>
				</tr>
			</thead>
			<tbody>
				@foreach($rows as $row)
				<tr>
					<td>
						{{$row->factor_ubicacion}}
					</td>
					<td>
						{{$row->valor_minimo}}
					</td>
					<td>
						{{$row->valor_maximo}}
					</td>
					<td>
						{{ ($row->status_factor_ubicacion==1 ? 'Activo' : 'Inactivo') }}
					</td>
					<td nowrap>
						{{ Form::open(array('method' => 'DELETE', 'route' => array('corevat.CatFactoresUbicacion.destroy', 'id'=>$row->idfactorubicacion))) }}
						<a href="{{ action('corevat_CatFactoresUbicacionController@edit',['id'=>$row->idfactorubicacion])}}" class="btn btn-warning" title="Editar registro"><span class="glyphicon glyphicon-pencil"></span></a>
						<a class="eliminar btn btn-danger" id="habilitar" href="/corevat/CatFactoresUbicacionE/{{$row->idfactorubicacion}}" title="Eliminar registro"><i class="glyphicon glyphicon-trash"></i></a>
						{{ Form::close() }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@section('javascript')
<script type="text/javascript">
$("body").delegate('.eliminar', 'click', function(){
	if(!confirm("¿Seguro que quiere eliminar el registro?")){
		return false;
	}
});
	$(document).ready(function () {
		$("#formFactorUbicacion").submit(function(){
			if ( parseFloat($("#valor_minimo").val()) <= parseFloat($("#valor_maximo").val()) ) {
				return true;
			} else {
				alert('¡El valor mínimo debe ser menor al valor máximo');
				return false;
			}
		});
	});
</script>
@stop

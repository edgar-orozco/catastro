
<div id="menu_rep">
	<div class="col-md-2">
		<a href="" class="btn btn-default customSize  {{ Request::is('reporte/index') ? 'active' : '' }}">Municipios</a>
	</div>
	<div class="col-md-2">
		<a href="" class="btn btn-default customSize {{ Request::is('reporte/perito') ? 'active' : '' }}">Perito</a>
	</div>
</div>
<br>
	<table class="table datatable">
		<thead>
			<tr>
				<th>COREVAT</th>
				<th>Nombre</th>
				<th>Rusticos entregados</th>
				<th>Urbanos entregados</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach($peritos as $perito)
				<tr>
					<td>{{$perito->corevat}}</td>
					<td>{{$perito->nombrep}}</td>
					<td>{{$perito->rusticos}}</td>
					<td>{{$perito->urbanos}}</td>
					<td>$ {{number_format($perito->total, 2)}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

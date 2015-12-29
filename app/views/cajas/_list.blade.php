@extends('layouts.default')

@section('styles')

.panel{
       	max-width: 800px; / change according to your requirement/
}
.center {
     float: none;
     margin-left: auto;
     margin-right: auto;
}
@stop

@section('content')

	<div class="panel panel-default center">
  		<div class="panel-heading">Apertura de Caja</div>
  		<div class="panel-body">
  		{{Form::open(['action'=>'Cajas_CajasController@create'])}}
  			<table class="table">
  				<thead>
	  				<tr>
	  					<th>Id</td>
	  					<th>No. Orden</td>
	  					<th>Nombre</td>
	  					<th>Monto</td>
	  					<th>Municipio</td>
	  					<th>Status</td>
  					</tr>
  				</thead>
  				<tbody>
  				@foreach($ordenes as $orden)
  					<tr>
  						<td>{{$orden['id']}}</td>
  						<td><a href="/cajas/{{$orden['id']}}/edit">{{$orden['no_orden']}}</a></td>
  						<td>{{$orden['nombre']}}</td>
  						<td>{{$orden['monto']}}</td>
  						<td>{{$orden['municipio']}}</td>
  						<td>
  							<div class="checkbox">
						    <label>
						      <input type="checkbox" value=""{{$orden['status']==='1'?'checked':''}} > Activar
						    </label>
  							
  						</td>
  					</tr>
  				@endforeach
  				</tbody>
  			</table>
        {{Form::Close()}}
        </div>
	</div>
@stop
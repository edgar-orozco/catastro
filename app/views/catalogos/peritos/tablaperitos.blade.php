

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Tabla de Peritos</h4>
	</div>
	<div class="panel-body">
        <br/>
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable example table-striped" id="example">
			<thead>
				<tr>
					<th>Corevat</th>
					<th>Perito</th>
					<th>Direccion</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($variableperito as $key=>$datosperitos)
				<tr <?php
                        if($key%2){
                            echo "class=''";
                        }
                        ?>>
					<td>{{$datosperitos->corevat}}</td>
					<td>{{$datosperitos->nombre}}</td>
					<td>{{$datosperitos->direccion}} </td>
					<td>
						<a href="actPerito/{{$datosperitos->id}}" class="btn btn-actionForm01 btn-info editar" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						@if($datosperitos->Estado == "1" )
							<a class="habilitar btn btn-actionForm01 btn-success" id="habilitar" href="estado/{{$datosperitos->id}}" title="Deshabilitar"><i class="glyphicon glyphicon-ok"></i></a>
						@else
							<a class="deshabilitar btn btn-actionForm01 btn-danger" id="deshabilitar" href="estado/{{$datosperitos->id}}" title="Habilitar"><i class="glyphicon glyphicon-remove"></i></a>
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

	
		{{Form::hidden('year', $year)}}
		<table class="table datatable" id="rustico-table">
			<thead>
				<tr>
					
					<!--<th>{{Form::checkbox('', '', '', ['id'=>'todos'])}}</th>-->
					<th>Marcar Folio Presentado</th>
					<th>Folio Autorizados</th>
					<th>Folio usado en el Municipio de:</th>
					<th>Fecha de Recepción</th>
					<th>Estado del Folio</th>
				</tr>
			</thead>
			<tbody>
				@foreach($fu as $u)
					<tr>
						<td align="center"> 
							@if($u->entrega_municipal == 0)
								{{Form::checkbox('urbanos[]', $u->numero_folio, '', ['class'=>'checkbox'])}}
							@else
								<i class="glyphicon glyphicon-ok"></i>
							@endif
						</td>
						<td align="center"> {{$u->corevat()}}</td>
						<td align="center"> 	
							@if($u->entrega_municipal == 1)
								{{$u->municipio->nombre_municipio}}
							@endif	
						<td align="center">
							@if($u->entrega_municipal == 1  && $u->fecha_entrega_m)
								{{$u->fecha_entrega_m}}
							@endif
						</td>
						<td align="center"> 
							@if($u->entrega_municipal == 0)
								Vigente
							@else
								Usado
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$fu->links()}}
        <div class="row">
            <div class="col-md-6 col-sm-6">
            </div>
        </div>
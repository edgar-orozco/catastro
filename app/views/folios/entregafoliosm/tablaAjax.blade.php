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
				@foreach($fr as $r)
					<tr>
						<td align="center"> 
							@if($r->entrega_municipal == 0)
								{{Form::checkbox('rusticos[]', $r->numero_folio, '', ['class'=>'checkbox'])}}
							@else
								<i class="glyphicon glyphicon-ok"></i>
							@endif
						</td>
						<td align="center"> {{$r->corevat()}}</td>
						<td align="center"> 	
							@if($r->entrega_municipal == 1)
								{{$r->municipio->nombre_municipio}}
							@endif	
						<td align="center">
							@if($r->entrega_municipal == 1  && $r->fecha_entrega_m)
								{{$r->fecha_entrega_m}}
							@endif
						</td>
						<td align="center"> 
							@if($r->entrega_municipal == 0)
								Vigente
							@else
								Usado
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$fr->links()}}
        <div class="row">
            <div class="col-md-6 col-sm-6">
            </div>
        </div>
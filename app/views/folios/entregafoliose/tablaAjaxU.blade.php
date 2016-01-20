{{Form::hidden('year', $year)}}
		<table class="table datatable" id="rustico-table">
			<thead>
				<tr>
					
					<!--<th>{{Form::checkbox('', '', '', ['id'=>'todos'])}}</th>-->
					<th>Marcar Folio Presentado</th>
					<th>Folio Autorizados</th>
					<th>Recibido Por:</th>
					<th>Fecha de Entrega Estatal</th>
					<th>Entregado en el municipio de:</th>
					<th>Fecha de Entrega Municipal</th>
					<th>Estado del Folio</th>
					<th>Opción temporal</th>
				</tr>
			</thead>
			<tbody>
				@foreach($fu as $r)
					<tr>
						<td align="center"> 
							@if($r->entrega_estatal == 0)
								{{Form::checkbox('urbanos[]', $r->numero_folio, '', ['class'=>'checkbox'])}}
							@else
								<i class="glyphicon glyphicon-ok"></i>
							@endif
						</td>

						<?php
							$input = $r->numero_folio;
							$input = str_pad($input, 4, "0", STR_PAD_LEFT);
						?>
						
						<td>{{$r->corevat()}}</td>
						<td align="center">
							@if($r->entrega_estatal == 1 && $r->usuario)
								{{$r->usuario->username}}
							@endif
						</td>
						<td align="center">
							@if($r->entrega_estatal == 1)
								{{$r->fecha_entrega_e}}
							@endif
						</td>
						<td align="center">
							@if($r->entrega_municipal == 1)
								{{$r->municipio->nombre_municipio}}
							@endif
						</td>
						<td align="center">
							@if($r->entrega_municipal == 1)
								{{$r->fecha_entrega_m}}
							@endif
						</td>
						<td align="center">
							@if($r->entrega_estatal == 0)
								Vigente
							@else
								Usado
							@endif
						</td>
						<td align="left" width="180"> 
							@if($r->entrega_municipal == 1)
								<a href="/entregafoliose/urbanos/habilitarm/{{$r->fc_id}}">Activar Municipal</a>
							@endif
							@if($r->entrega_estatal == 1)
								<a href="/entregafoliose/urbanos/habilitare/{{$r->fc_id}}">Activar Estatal</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$fu->links()}}
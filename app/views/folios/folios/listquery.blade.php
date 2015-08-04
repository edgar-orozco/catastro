<table class="table-bordered">
	<thead>
		<tr>
			@foreach($resultado[0] as $res => $val)
			<th align="center">{{$res}}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($resultado as $res)
			<tr>
				@foreach($fields as $field)
					<td>{{$res->$field}}</td>
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">INPC</h3>
    </div>
   @if(count($inpcs) == 0)
        <div class="panel-body">
            <p>No hay requisitos dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
    <table class="table">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Año</th>
                <th>INPC</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inpcs as $row)
            <tr>
                <td>
                    {{$row->mes}}
                </td>
                <td>
                    {{$row->anio}}
                </td>
                <td>
                    {{$row->inpc}}
                </td>
                <td nowrap>
                   {{ Form::open(array('method' => 'DELETE', 'route' => array('catalogos.inpc.destroy', 'id'=>$row->id_inpc))) }}
                    <a href="{{ action('catalogos_inpcController@edit',['id'=>$row->id_inpc])}}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="eliminar btn btn-danger" id="habilitar" href="/catalogos/inpcE/{{$row->id_inpc}}" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
	    	if(!confirm("¿Seguro que quiere eliminar el INPC?")){
	    		return false;
	    	}

	});


</script>
@stop
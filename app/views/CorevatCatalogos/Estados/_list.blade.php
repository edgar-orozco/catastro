<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{$titleGrid}}</h3>
    </div>
    @if(count($rows) == 0)
    <div class="panel-body">
        <p>No existen registros.</p>
    </div>
    @endif
    <div class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estados</th>
                    <th>Clave</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td>
                        <a href="{{ action('corevat_EstadosController@edit',['id'=>$row->idestado])}}" class="link center" title="Editar requisito">{{$row->idestado}}</a>                        
                    </td>
                    <td>
                        {{$row->estado}}
                    </td>
                    <td>
                        {{$row->clave}}
                    </td>
                    <td>
                        {{$row->status}}
                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('corevat.Estados.destroy', 'id'=>$row->idestado))) }}
                        <a href="{{ action('corevat_EstadosController@edit',['id'=>$row->idestado])}}" class="btn btn-warning" title="Editar requisito"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="eliminar btn btn-danger" id="habilitar" href="/corevat/EstadosE/{{$row->idestado}}" title="Deshabilitar"><i class="glyphicon glyphicon-trash"></i></a>
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
	if(!confirm("¿Seguro que quiere eliminar el salario minimo?")){
		return false;
	}
});
</script>
@stop

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
                    <th>Estado</th>
                    <th>Clave</th>
                    <th>Municipio</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td>
                        <a href="{{ action('corevat_MunicipiosController@edit',['id'=>$row->idmunicipio])}}" class="link center" title="Editar requisito">{{$row->idmunicipio}}</a>                        
                    </td>
                    <td>
                        {{$row->estado}}
                    </td>
                    <td>
                        {{$row->clave}}
                    </td>
                    <td>
                        {{$row->municipio}}
                    </td>
                    <td>
                        @if(intval($row->statusmun) == 1)
                            <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-ban-circle text-danger" aria-hidden="true"></span>
                        @endif

                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('corevat.Municipios.destroy', 'id'=>$row->idmunicipio))) }}
                        <a href="{{ action('corevat_MunicipiosController@edit',['id'=>$row->idmunicipio])}}" class="btn btn-warning" title="Editar requisito"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="eliminar btn btn-danger" id="habilitar" href="/corevat/MunicipiosE/{{$row->idmunicipio}}" title="Deshabilitar"><i class="glyphicon glyphicon-trash"></i></a>
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

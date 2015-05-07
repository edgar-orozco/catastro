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
					<th>Razón Social</th>
					<th>Nombre Comercial</th>
					<th>DF</th>
					<th>RFC</th>
					<th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td>
                        {{$row->rs}}
                    </td>
                    <td>
                        {{$row->ncomer}}
                    </td>
                    <td>
                        {{$row->df}}
                    </td>
                    <td>
                        {{$row->rfc}}
                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('corevat.Empresas.destroy', 'id'=>$row->idemp))) }}
                        <a href="{{ action('corevat_EmpresasController@edit',['id'=>$row->idemp])}}" class="btn btn-warning" title="Editar requisito"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="eliminar btn btn-danger" id="habilitar" href="/corevat/EmpresasE/{{$row->idemp}}" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
    $("body").delegate('.eliminar', 'click', function () {
        if (!confirm("¿Seguro que quiere eliminar el registro?")) {
            return false;
        }
    });
</script>
@stop
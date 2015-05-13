<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{$titleGrid}}</h3>
    </div>
    @if(count($rows) == 0)
    <div class="panel-body">
        <p>No hay requisitos dados de alta actualmente en el sistema.</p>
    </div>
    @endif
    <div class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th>Mínimo</th>
                    <th>Máximo</th>
                    <th>Resultante</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td>
                        {{$row->minimo}}
                    </td>
                    <td>
                        {{$row->maximo}}
                    </td>
                    <td>
                        {{$row->resultante}}
                    </td>
                    <td>
                        {{ ($row->status_factor_superficie==1 ? 'Activo' : 'Inactivo') }}
                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('corevat.CatFactoresSuperficie.destroy', 'id'=>$row->idfactorsuperficie))) }}
                        <a href="{{ action('corevat_CatFactoresSuperficieController@edit',['id'=>$row->idfactorsuperficie])}}" class="btn btn-warning" title="Editar registro"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="eliminar btn btn-danger" id="habilitar" href="/corevat/CatFactoresSuperficieE/{{$row->idfactorsuperficie}}" title="Eliminar registro"><i class="glyphicon glyphicon-trash"></i></a>
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
	if(!confirm("¿Seguro que quiere eliminar el registro?")){
		return false;
	}
});
</script>
@stop

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Ejecutores</h3>
    </div>
    @if(count($ejecutoress) == 0)
    <div class="panel-body">
        <p>No hay requisitos dados de alta actualmente en el sistema.</p>
    </div>
    @endif
    <div class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Nombre del ejecutor</th>
                    <th>cargo</th>
                    <th>Fecha Nombramiento</th>
                    <th>Quien lo nombra</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ejecutoress as $row)
                <tr>
                    <td>
                        {{$row->titulo}}
                    </td>
                    <td>
                        {{$row->nombres}} {{$row->apellido_paterno}} {{$row->apellido_materno}}
                    </td>
                    <td>
                        {{$row->cargo}}
                    </td>
                    <td>
                        {{$row->f_nombramiento}}
                    </td>
                    <td>
                        {{$row->nombre}} {{$row->p_paterno}} {{$row->p_materno}}
                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('catalogos.ejecutores.destroy', 'id'=>$row->id_ejecutor))) }}
                        <a href="{{ action('catalogos_ejecutoresController@edit',['id'=>$row->id_ejecutor])}}" class="btn btn-warning" title="Editar requisito">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a class="eliminar btn btn-danger" id="habilitar" href="/catalogos/ejecutoresE/{{$row->id_ejecutor}}" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
        if (!confirm("¿Seguro que quiere eliminar el Ejecutor?")) {
            return false;
        }
    });
</script>
@stop
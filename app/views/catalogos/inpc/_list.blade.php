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
                    {{$row->nombre_mes}}
                </td>
                <td>
                    {{$row->anio}}
                </td>
                <td>
                    {{$row->inpc}}
                </td>
                <td nowrap>
                   {{ Form::open(array('method' => 'DELETE', 'route' => array('catalogos.inpc.destroy', 'id'=>$row->id_inpc))) }}
                    <a href="{{ action('catalogos_inpcController@edit',['id'=>$row->id_inpc])}}" class="btn btn-warning" title="Editar requisito">
                        <span class="glyphicon glyphicon-pencil"></span>
                   </a>
                    
                   
                   <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                   </button>
                   {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

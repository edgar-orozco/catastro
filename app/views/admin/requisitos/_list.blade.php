<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Requisitos de trámites catastrales</h3>
    </div>
    @if(count($requisitos) == 0)
        <div class="panel-body">
            <p>No hay requisitos dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del requisito</th>
                <th>Tipo de requisito</th>
                <th>Descripción del requisito</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requisitos as $requisito)
            <tr>
                <td>
                    {{$requisito->nombre}}
                </td>
                <td>
                    {{$requisito->tipo}}
                </td>
                <td>
                    {{$requisito->descripcion}}
                </td>
                <td nowrap>
                    <a href="{{ action('RequisitosController@edit', ['id' => $requisito->id]) }}" class="btn btn-warning" title="Editar requisito">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <a href="{{ action('RequisitosController@destroy', ['id' => $requisito->id]) }}" class="btn btn-danger" title="Borrar requisito">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
{{ $requisitos->appends(Request::except('page'))->links() }}


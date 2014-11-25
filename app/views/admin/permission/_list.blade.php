<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Permisos del sistema</h3>
    </div>
    @if(count($permissions) == 0)
        <div class="panel-body">
            <p>No hay permisos dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del permiso</th>
                <th>Descripción del permiso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>
                    {{$permission->name}}
                </td>
                <td>
                    {{$permission->display_name}}
                </td>
                <td>
                    <a href="{{ action('AdminPermissionsController@edit', ['id' => $permission->id]) }}" class="btn btn-warning" title="Editar permiso">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <a href="{{ action('AdminPermissionsController@destroy', ['id' => $permission->id]) }}" class="btn btn-danger" title="Borrar permiso">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>



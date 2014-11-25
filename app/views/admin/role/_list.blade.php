<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Roles del sistema</h3>
    </div>
    @if(count($roles) == 0)
        <div class="panel-body">
            <p>No hay roles dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
        <table class="table" >
            <thead>
                <tr>
                    <th>Rol</th>
                    <th style="text-align: center;">Permisos del rol</th>
                    <th style="text-align: right;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td nowrap>
                        {{$role->name}}
                    </td>
                    <td>

                            {{ implode(", ", $role->perms->lists('display_name')) }}

                    </td>
                    <td style="text-align: right;" nowrap>
                        <a href="{{ action('AdminRolesController@edit', ['id' => $role->id]) }}" class="btn btn-warning" title="Editar rol">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <a href="{{ action('AdminRolesController@destroy', ['id' => $role->id]) }}" class="btn btn-danger" title="Borrar rol">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


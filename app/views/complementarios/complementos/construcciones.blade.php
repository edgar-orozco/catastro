<table class="table">
    <thead>
        <tr>

            <th>Uso</th>
            <th>Superficie</th>
            <th>Niveles</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $url = URL::current();
        $new = explode("/", $url);
        $count = count($new);
        $count = $count - 1;
        $clave = $new[$count];
        ?>
        @foreach($const as $construccion)   
        <tr>
            <td>{{$construccion->descripcion}}</td>
            <td>{{$construccion->sup_const}}</td>
            <td>{{$construccion->nivel}}</td>
            <td nowrap>
                <a href="/complementos-editar/{{$construccion->gid_construccion}}" class="btn btn-warning nuevo" title="Editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a href="/cargar-complementos-eliminar/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>

            </td>
        </tr>
        @endforeach
    <tfoot>
        <tr>
            <th scope="col"  colspan="9"><a href="/agregar-construccion/{{$clave}}"  class="btn btn-primary nuevo">Agregar Nuevo</a></th>
        </tr>
    </tfoot>
</table>

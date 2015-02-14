<table class="table">
    <thead>
        <tr>
<!--            <th>ID</th>
            <th>Clave</th> -->
            <th>Tipos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $url = URL::current();
        $new = explode("/", $url);
//        var_dump($new);
        $count = count($new);
        $count = $count - 1;
        $clave=$new[$count];
        ?>
        @foreach($datos as $row)   
        <tr>
           
            <td>{{$row->descripcion }}</td>
            <td nowrap>
                <a href="/cargar-complementos-editar/{{$row->id_ie }}" class="btn btn-warning nuevo" title="Editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a href="/cargar-complementose/{{$row->id_ie }}" class="btn btn-danger" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    <tfoot>
        <tr>
             
            <th scope="col"  colspan="9">  <a href="/agregar/{{$clave}}"  class="btn btn-primary nuevo">Agregar Nuevo</a></th>
        </tr>
    </tfoot>
</table>
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
                <a data-toggle="modal" data-target="#agregar-instalaciones" href="/cargar-complementos-editar/{{$row->id_ie }}" class="btn btn-warning nuevo" title="Editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                 <!--Modal-->
                 <div class="modal" id="agregar-instalaciones" tabindex="-1" role="dialog"  aria-labelledby="agregar-instalaciones" aria-hidden="true">  
                    <div class="modal-dialog">
                        <div class="modal-content">               
                            <div class="modal-body">
                              
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--borrar-->
                <a href="/cargar-complementose/{{$row->id_ie }}" class="btn btn-danger" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    <tfoot>
        <tr>
             
            <th scope="col"  colspan="9"> 
                <a data-toggle="modal" data-target="#instalaciones-especiales" href="/agregar/{{$clave}}"  class="btn btn-primary nuevo">Agregar Nuevo</a></th>
        </tr>
    <div class="modal fade" id="instalaciones-especiales" tabindex="-1" role="dialog"  aria-labelledby="instalaciones-especiales" aria-hidden="true">  
        <div class="modal-dialog">
            <div class="modal-content">               
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>
    </tfoot>
</table>
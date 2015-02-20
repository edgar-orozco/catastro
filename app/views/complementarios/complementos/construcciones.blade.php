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
                <a data-toggle="modal" data-target="#construcciones-editar" href="/complementos-editar/{{$construccion->gid_construccion}}" class="btn btn-warning nuevo" title="Editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                  <!--Modal-->
                 <div class="modal fade" id="construcciones-editar" tabindex="-1" role="dialog"  aria-labelledby="construcciones-editar" aria-hidden="true">  
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
                <a href="/cargar-complementos-eliminar/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>

            </td>
        </tr>
        @endforeach
    <tfoot>
        <tr>
            <th scope="col"  colspan="9">
                <a data-toggle="modal" data-target="#construcciones" href="/agregar-construccion/{{$clave}}"  class="btn btn-primary nuevo">Agregar Nuevo</a>
            </th>
        </tr>
    <div class="modal fade" id="construcciones" tabindex="-1" role="dialog"  aria-labelledby="construcciones" aria-hidden="true">  
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

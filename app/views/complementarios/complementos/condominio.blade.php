
<table class="table">
    <thead>
        <tr>
            <th>Numero Condominal</th>
            <th>Superficie Privativa</th>
            <th>Superficie Comun</th>
            <th>Indiviso</th>
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
        {{@foreach($condominio as $row)
        <tr>
            <td>{{$row->no_condominal }}</td>
            <td>{{$row->tipo_priva }}</td>
            <td>{{$row->sup_comun }}</td>
            <td>{{$row->indiviso }}</td>
            <td nowrap>
                <a data-toggle="modal" data-target="#condominio-editar"   href="/cargar-condominio-editar/{{$row->id_condominio}}" class="btn btn-warning nuevo" title="Editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <!--Modal-->
                 <div class="modal fade" id="condominio-editar" tabindex="-1" role="dialog"  aria-labelledby="condominio-editar" aria-hidden="true">  
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
                <a href="/cargar-condominio-destroy/{{$row->id_condominio}}" class="btn btn-danger nuevo" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach}}
    <tfoot>
        <tr>
            <th scope="col"  colspan="9">
                <a data-toggle="modal" data-target="#condominio"  href="/agregar-condominio/{{$clave}}" class="btn btn-primary">Agregar Nuevo</a>
            </th>
        </tr>
    <div class="modal fade" id="condominio" tabindex="-1" role="dialog"  aria-labelledby="condominio" aria-hidden="true">  
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @include('complementarios.agregarcondominio')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>
</tfoot>
</table>

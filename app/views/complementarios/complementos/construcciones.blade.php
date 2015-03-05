<table class="table">
    <thead>
        <tr>
            <th>Detalles </th>
            <th>ID </th>
            <th>Uso</th>
            <th>Superficie</th>
            <th>Niveles</th>
            <th>Edad Construccion</th>
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
        {{ Form::hidden('gidc',$construccion->gid_construccion) }}
        @foreach($const as $construccion)  
        <tr>

            <td class="col-md-8">
                <button data-toggle="collapse" data-target=".demo1{{$construccion->gid_construccion}}"><span class="glyphicon glyphicon-plus"></span></button>
            </td>
            <td>{{$construccion->gid_construccion}}</td>
            <td>{{$construccion->descripcion}}</td>
            <td>{{$construccion->sup_const}}</td>
            <td>{{$construccion->nivel}}</td>
            <td>{{$construccion->edad_const}}</td>
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
        <tr class="collapse demo1{{$construccion->gid_construccion}}">
            <td colspan="2" class="col-md-8">
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Techo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>      
                                <?php $x = $construccion->gid_construccion; ?>
                                @foreach($techos as $techo) 
                                <?php $y = $techo->gid_construccion; ?>
                                @if($x == $y)

                            <tr>  

                                <td>{{$techo->descripcion}}</td>

                                <td nowrap>

                                    <!--Modal-->
                                    <div class="modal" id="agregar-techos" tabindex="-1" role="dialog"  aria-labelledby="agregar-techos" aria-hidden="true">  
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
                                    <a href="/cargar-complementos/eliminar-techos/{{$techo->id}}/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>  
                            @endif
                            @endforeach


                        </tbody>
                    </table>
                    <a data-toggle="modal" data-target="#agregar-techos" href="/cargar-complementos/agregar-techos/{{$construccion->gid_construccion}}" class="btn btn-info" title="Editar">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>

                    <!--tabla inicio-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Muros</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>      
                                <?php $x = $construccion->gid_construccion; ?>
                                @foreach($muros as $muro) 
                                <?php $y = $muro->gid_construccion; ?>
                                @if($x == $y)


                            <tr>  
                                <td>{{$muro->descripcion}}</td>
                                <td nowrap>
                                    <!--Modal-->
                                    <div class="modal" id="agregar-techos" tabindex="-1" role="dialog"  aria-labelledby="agregar-techos" aria-hidden="true">  
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
                                    <a href="/cargar-complementos/eliminar-muros/{{$muro->id}}/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>  

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/cargar-complementos/agregar-muros/{{$construccion->gid_construccion}}" class="btn btn-info" title="Editar">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                    <!--tabla fin  -->
                    <!--tabla inicio-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Clase Construccion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>      
                                <?php $x = $construccion->gid_construccion; ?>
                                @foreach($clases as $clase) 
                                <?php $y = $clase->gid_construccion; ?>
                                @if($x == $y)


                            <tr>  
                                <td>{{$clase->descripcion}}</td>
                                <td nowrap>
                                    <!--Modal-->
                                    <div class="modal" id="agregar-techos" tabindex="-1" role="dialog"  aria-labelledby="agregar-techos" aria-hidden="true">  
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
                                    <a href="/cargar-complementos/eliminar-clase-construccion/{{$clase->id}}/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>  
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/cargar-complementos/agregar-clase-construccion/{{$construccion->gid_construccion}}" class="btn btn-info" title="Editar">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                    <!--tabla fin  -->
            </td>
            </div> 
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

<table class="table">
    <thead>
        <tr>
            <th>Detalles </th>

            <th>Uso</th>
            <th>Superficie</th>
            <th>Niveles</th>
            <th>Edad</th>
            <th>Clase</th>
            <th>Estado</th>
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
                <button data-toggle="collapse" data-target=".demo1{{$construccion->gid_construccion}}"><span class="glyphicon glyphicon-chevron-down"></span></button>
            </td>

            <td>{{$construccion->DescripcionUso}}</td>
            <td>{{$construccion->Superficie}}</td>
            <td>{{$construccion->Nivel}}</td>
            <td>{{$construccion->Edad}}</td>
            <td>{{$construccion->DescripcionClase}}</td>
            <td>{{$construccion->Estado}}</td>
          

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
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                    <a data-toggle="modal" data-target="#agregar-muros"  href="/cargar-complementos/agregar-muros/{{$construccion->gid_construccion}}" class="btn btn-info" title="Editar">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                    <!--tabla fin  -->
               
                    <!--tabla inicio-->
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Ventanas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>      
                                <?php $x = $construccion->gid_construccion; ?>
                                @foreach($ventanas as $ventana) 
                                <?php $y = $ventana->gid_construccion; ?>
                                @if($x == $y)
                            <tr>  
                                <td>{{$ventana->descripcion}}</td>
                                <td nowrap>
                                    <!--Modal-->

                                    <!--borrar-->
                                    <a href="/cargar-complementos/eliminar-muros/{{$ventana->id}}/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>  
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <a data-toggle="modal" data-target="#agregar-ventanas" href="/cargar-complementos/agregar-ventanas/{{$construccion->gid_construccion}}" class="btn btn-info" title="Editar">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                    <!--tabla fin-->
                      <!--tabla inicio-->
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Puertas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>      
                                <?php $x = $construccion->gid_construccion; ?>
                               @foreach($puertas as $puerta) 
                                <?php $y = $puerta->gid_construccion; ?>
                                @if($x  == $y)
                            <tr>  
                                  <td>{{$puerta->descripcion}}</td>
                                <td nowrap>
                                    <!--Modal-->

                                    <!--borrar-->
                                    <a href="/cargar-complementos/eliminar-puertas/{{$puerta->id_tipopuerta}}/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>  
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <a data-toggle="modal" data-target="#agregar-puertas" href="/cargar-complementos/agregar-puertas/{{$construccion->gid_construccion}}" class="btn btn-info" title="Editar">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                    <!--tabla fin-->
                    
                    <!--tabla inicio-->
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Pisos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>      
                                <?php $x = $construccion->gid_construccion; ?>
                               @foreach($pisos as $piso) 
                                <?php $y = $piso->gid_construccion; ?>
                                @if($x  == $y)
                            <tr>  
                                <td>{{$piso->descripcion}}</td>
                                <td nowrap>
                                    <!--Modal-->

                                    <!--borrar-->
                                    <a href="/cargar-complementos/eliminar-pisos/{{$piso->id_tipopiso}}/{{$construccion->gid_construccion}}" class="btn btn-danger" title="Borrar">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>  
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <a data-toggle="modal" data-target="#agregar-pisos"  href="/cargar-complementos/agregar-pisos/{{$construccion->gid_construccion}}" class="btn btn-info" title="Editar">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                    <!--tabla fin-->
                </div>
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
<!--modal techos-->
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
<!--Modal Muros-->
<div class="modal" id="agregar-muros" tabindex="-1" role="dialog"  aria-labelledby="agregar-muros" aria-hidden="true">  
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
<!--modal ventana-->
<div class="modal" id="agregar-ventanas" tabindex="-1" role="dialog"  aria-labelledby="agregar-ventanas" aria-hidden="true">  
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
<!--modal puerta-->
<div class="modal" id="agregar-puertas" tabindex="-1" role="dialog"  aria-labelledby="agregar-puertas" aria-hidden="true">  
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
<!--modal pisos-->
<div class="modal" id="agregar-pisos" tabindex="-1" role="dialog"  aria-labelledby="agregar-pisos" aria-hidden="true">  
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
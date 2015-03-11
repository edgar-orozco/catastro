<div class="panel">
    <div class="panel-heading">
        <!--h3 class="panel-title">Configuracion Municipal</h3-->
    </div>
    @if(count($configuracionMunicipales) == 0)
    <div class="panel-body">
        <p>No hay requisitos dados de alta actualmente en el sistema.</p>
    </div>
    @endif
    <div class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th>Municipio</th>
                    <th width="20%"><div align="center">Nombre</div></th>
                    <th width="20%"><div align="center">Cargo</div></th>
                    <th><div align="center">Gasto Ejecucion<br>Porcentaje</div></th>
                    <!--td>Descuento-->
                    <th><div align="center">Descuento<br>Multa</div></th>
                    <th><div align="center">Descuento<br>Gasto Ejecicion</div></th>
                    <th><div align="center">Descuento<br>Recarga</div></th>
                    <th><div align="center">Descuento<br>Actualización</div></th>
                    <!--/td-->
                    <th><div align="center">Acciones</div></th>
                </tr>
            </thead>
            <tbody>
                @foreach($configuracionMunicipales as $row)
                <tr>
                    <td>
                        {{$row->nombre_municipio}}
                    </td>
                    <td>
                        {{$row->nombre}}
                    </td>
                    <td>
                        {{$row->cargo}}
                    </td>
                    <td>
                        {{$row->gastos_ejecucion_porcentaje}}
                    </td>
                    <td>
                        {{$row->descuento_multa}}
                    </td>
                    <td>
                        {{$row->descuento_gasto_ejecucion}}
                    </td>
                    <td>
                        {{$row->descuento_recargo}}
                    </td>
                    <td>
                        {{$row->descuento_actualizacion}}
                    </td>
                    <td nowrap>
                        <a href="{{ action('catalogos_configuracionController@edit',['id'=>$row->id_configuracion])}}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="btn btn-danger" data-toggle="modal"  data-target="#Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
                
<!-- Modal -->
<div class="modal fade" id="Eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="modalBody" >
                Desa eliminar la configuracion municipal "{{$row->nombre_municipio}}"
            </div>
            <div class="modal-footer" id="modal-footer">
                <a class="btn btn-danger" href="/catalogos/configuraciond/{{$row->id_configuracion}}">
                Eliminar
                </a>
                <a class="btn btn-warning" type="button"  data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->

                @endforeach
            </tbody>
        </table>
    </div>
</div>



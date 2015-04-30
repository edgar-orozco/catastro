<div class="panel">
    <div class="panel-heading">
        
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th colspan="4" border="1"><div align="center">Descuento</div></th>
                    
                    <td></td>
                </tr>
                <tr>
                    <th>Municipio</th>
                    <th width="20%"><div align="center">Nombre</div></th>
                    <th width="20%"><div align="center">Cargo</div></th>
                    <th><div align="center">Gasto Ejecución<br>Porcentaje</div></th>
                    <!--td>Descuento-->
                    <th><div align="center">Multa</div></th>
                    <th><div align="center">Gasto Ejecición</div></th>
                    <th><div align="center">Recarga</div></th>
                    <th><div align="center">Actualización</div></th>
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
                        <div align="center">{{$row->gastos_ejecucion_porcentaje}}</div>
                    </td>
                    <td>
                        <div align="center">{{$row->descuento_multa}}</div>
                    </td>
                    <td>
                        <div align="center">{{$row->descuento_gasto_ejecucion}}</div>
                    </td>
                    <td>
                        <div align="center">{{$row->descuento_recargo}}</div>
                    </td>
                    <td>
                        <div align="center">{{$row->descuento_actualizacion}}</div>
                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('catalogos.configuracion.destroy', 'id'=>$row->id_configuracion))) }}
                        <a href="{{ action('catalogos_configuracionController@edit',['id'=>$row->id_configuracion])}}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="eliminar btn btn-danger" id="habilitar" href="/catalogos/configuracionE/{{$row->id_configuracion}}" title="Deshabilitar"><i class="glyphicon glyphicon-trash"></i></a>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@section('javascript')
<script type="text/javascript">
    
$("body").delegate('.eliminar', 'click', function(){
	    	if(!confirm("¿Seguro que quiere eliminar el salario minimo?")){
	    		return false;
	    	}

	});


</script>
@stop

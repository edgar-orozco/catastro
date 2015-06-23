<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Notaria</h3>
    </div>
    @if(count($Notarias) == 0)
    <div class="panel-body">
        <p>No hay notarias dados de alta actualmente en el sistema.</p>
    </div>
    @endif
    <div class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th>Entidad</th>
                    <th>Municipio</th>
                    <th>Notaria</th>
                    <th>Nombre Notario</th>
                    <th>Nombre Responsable</th>
                    <th>Domicilio</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Notarias as $row)
                <tr>
                    <td>
                        <?php 
                    if($row->entidad == 1)
                    {
                        echo "Distrito Federal";
                    }
                     if($row->entidad == 2)
                    {
                        echo "Aguascalientes";
                    }
                     if($row->entidad == 3)
                    {
                        echo "Baja California";
                    }
                     if($row->entidad == 4)
                    {
                        echo "Baja California Sur";
                    }
                     if($row->entidad == 5)
                    {
                        echo "Campeche";
                    }
                     if($row->entidad == 6)
                    {
                        echo "Chiapas";
                    }
                     if($row->entidad == 7)
                    {
                        echo "Chihuahua";
                    }
                     if($row->entidad == 8)
                    {
                        echo "Coahuila de Zaragoza";
                    }
                     if($row->entidad == 9)
                    {
                        echo "Colima";
                    }
                     if($row->entidad == 10)
                    {
                        echo "Durango";
                    }
                     if($row->entidad == 11)
                    {
                        echo "Guanajuato";
                    } if($row->entidad == 12)
                    {
                        echo "Guerrero";
                    } if($row->entidad == 13)
                    {
                        echo "Hidalgo";
                    } if($row->entidad == 14)
                    {
                        echo "Jalisco";
                    } if($row->entidad == 15)
                    {
                        echo "México";
                    } if($row->entidad == 16)
                    {
                        echo "Michoacán de Ocampo";
                    } if($row->entidad == 17)
                    {
                        echo "Morelos";
                    } if($row->entidad == 18)
                    {
                        echo "Nayarit";
                    } if($row->entidad == 19)
                    {
                        echo "Nuevo León";
                    } if($row->entidad == 20)
                    {
                        echo "Oaxaca";
                    } if($row->entidad == 21)
                    {
                        echo "Puebla";
                    } if($row->entidad == 22)
                    {
                        echo "Querétaro de Arteaga";
                    } if($row->entidad == 22)
                    {
                        echo "Quintana Roo";
                    } if($row->entidad == 24)
                    {
                        echo "San Luis Potosí";
                    } if($row->entidad == 25)
                    {
                        echo "Sinaloa";
                    } if($row->entidad == 26)
                    {
                        echo "Sonora";
                    } if($row->entidad == 27)
                    {
                        echo "Tabasco";
                    } if($row->entidad == 28)
                    {
                        echo "Tamaulipas";
                    } if($row->entidad == 29)
                    {
                        echo "Tlaxcala";
                    } if($row->entidad == 30)
                    {
                        echo "Veracruz de Ignacio de la Llave";
                    } if($row->entidad == 31)
                    {
                        echo "Yucatán";
                    } if($row->entidad == 31)
                    {
                        echo "Zacatecas";
                    }                
                    ?>
                    </td>
                    <td>
                        {{$row->nombre_municipio}}
                    </td>
                    <td>
                        {{$row->notaria}}
                        
                    </td>
                    <td>
                        {{$row->nombres}} {{$row->apellido_paterno}} {{$row->appellido_materno}}
                    </td>
                    <td>
                        {{$row->nombre}} {{$row->paterno}} {{$row->materno}}
                    </td>
                    <td>
                        {{$row->domicilio}}
                    </td>
                    <td>
                        {{$row->telefono}}
                    </td>
                    <td nowrap>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.notaria.destroy', 'id'=>$row->id_notaria))) }}
                        <a href="{{ action('admin_notariaController@edit',['id'=>$row->id_notaria])}}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="eliminar btn btn-danger" id="habilitar" href="/admin/notariaE/{{$row->id_notaria}}" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$Notarias->links();}}
    </div>
</div>
@section('javascript')
<script type="text/javascript">
    
$("body").delegate('.eliminar', 'click', function(){
	    	if(!confirm("¿Seguro que quiere eliminar la notaria?")){
	    		return false;
	    	}

	});


</script>
@stop
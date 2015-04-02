<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">INPC</h3>
    </div>
   @if(count($inpcs) == 0)
        <div class="panel-body">
            <p>No hay requisitos dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
    <table class="table">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Año</th>
                <th>INPC</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inpcs as $row)
            <tr>
                <td>
                    <?php 
                    if($row->mes == 1)
                    {
                        echo "Enero";
                    }
                     if($row->mes == 2)
                    {
                        echo "Febrero";
                    }
                     if($row->mes == 3)
                    {
                        echo "Marzo";
                    }
                     if($row->mes == 4)
                    {
                        echo "Abril";
                    }
                     if($row->mes == 5)
                    {
                        echo "Mayo";
                    }
                     if($row->mes == 6)
                    {
                        echo "Junio";
                    }
                     if($row->mes == 7)
                    {
                        echo "Julio";
                    }
                     if($row->mes == 8)
                    {
                        echo "Agosto";
                    }
                     if($row->mes == 9)
                    {
                        echo "Septiembre";
                    }
                     if($row->mes == 10)
                    {
                        echo "Octubre";
                    }
                     if($row->mes == 10)
                    {
                        echo "Noviembre";
                    } if($row->mes == 12)
                    {
                        echo "Diciembre";
                    }                    
                    ?>
                    
                </td>
                <td>
                    {{$row->anio}}
                </td>
                <td>
                    {{$row->inpc}}
                </td>
                <td nowrap>
                   {{ Form::open(array('method' => 'DELETE', 'route' => array('catalogos.inpc.destroy', 'id'=>$row->id_inpc))) }}
                    <a href="{{ action('catalogos_inpcController@edit',['id'=>$row->id_inpc])}}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="eliminar btn btn-danger" id="habilitar" href="/catalogos/inpcE/{{$row->id_inpc}}" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
	    	if(!confirm("¿Seguro que quiere eliminar el INPC?")){
	    		return false;
	    	}

	});


</script>
@stop
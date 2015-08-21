@extends('layouts.default')

<!--Agrego para el datatable-->
    {{ HTML::style('/css/bootstrap.min.css') }}
    {{ HTML::style('/css/dataTables.bootstrap.css') }}

@section('content')

<div class="page-header">
    <h3>Informe de Folios Emitidos</h3>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Tabla de Folios Emitidos</h4>
	</div>
	<div class="panel-body">
        <br/>
        {{Form::open(['id' => 'foliosE', 'method' => 'GET'])}}
        {{Form::select('year', $selectYear, null,  ['id' => 'year', 'class' => 'form-control input-sm', 'aria-controls' => 'emitidos-table'])}}
        {{Form::close()}}
        <br/>
        <table class="table datatable" id="emitidos-table" >
            <thead>
                <tr>
                    <th>No. Oficio</th>
                    <th>Corevat No.</th>
                    <th>Perito</th>
                    <th>Fecha de Oficio</th>
                    <th>Folios Urbanos</th>
                    <th>Folios Rusticos</th>
                    <th>Usuario</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($femitidos as $folios)

            <?php

            $fechaBD=date_parse($folios->fecha_oficio);
            $fecha = array();

                $fecha['1'] = "Enero";
                $fecha['2'] = "Febrero";
                $fecha['3'] = "Marzo";
                $fecha['4'] = "Abril";
                $fecha['5'] = "Mayo";
                $fecha['6'] = "Junio";
                $fecha['7'] = "Julio";
                $fecha['8'] = "Agosto";
                $fecha['9'] = "Septiembre";
                $fecha['10'] = "Octubre";
                $fecha['11'] = "Noviembre";
                $fecha['12'] = "Diciembre";
                ?>

                <tr>
                <?php $datos_perito = Perito::where('id', $folios->perito_id)->first();?>

                    <td align="center">{{$folios->no_oficio}}</td>
                    <td align="center">{{$datos_perito->corevat}}</td>
                    <td align="center">{{$datos_perito->nombre}}</td>
                    <td align="center">{{$fechaBD['day']. " de " . $fecha[$fechaBD['month']]}}</td>
                    <td align="center">{{$folios->cantidad_urbanos}}</td>
                    <td align="center">{{$folios->cantidad_rusticos}}</td>
                    <td align="center">{{$folios->id_usuario}}</td>
                    <td align="center"><a href="formato/{{$folios->id}}" target="_blank" class="btn btn-xs btn-info" title="Reimprimir"><i class="glyphicon glyphicon-print"></i></a>
                    <a href="eliminarFolio/{{$folios->no_oficio}}" class="eliminar btn btn-xs btn-danger" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
	</div>
</div>
	@stop

@section('javascript')

{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}

	<script type="text/javascript">

	$(document).ready(function(){


		$('#year').on('change', function()
			{
				$( "#foliosE" ).submit();
			});

		$('body').delegate('.eliminar', 'click', function(event) {

			if(!confirm("¿Está seguro de eliminar esta emisión?")){

				return false;

			}

		});

		$('#emitidos-table').dataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros","search": "Filter records:",
            "search": "Buscar:",
            "infoFiltered": "(Filtrado en _MAX_ total de registros)",
            "oPaginate": {
		      "sPrevious": "Anterior",
		      "sNext": "Siguiente"
		    }
        }
	    });

	    var table = $('#emitidos-table').DataTable();
 
		// #column3_search is a <input type="text"> element
		$('#prueba').on( 'keyup', function () {
		    table
		        .columns( 0 )
		        .search( this.value )
		        .draw();
} );

	});

	</script>

@stop
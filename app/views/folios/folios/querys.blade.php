@extends('layouts.default')

<style type="text/css">
	

	/* Tables */
	.Table-Normal {
	    position: relative;
	    margin: 10px auto;
	    padding: 0;
	    width: 100%;
	    height: auto;
	    border-collapse: collapse;
	    text-align: center;
	}

	.Table-Normal thead tr {
	    background-color: #E74C3C;
	    font-weight: bold;
	}

	.Table-Normal tbody tr {
	    margin: 0;
	    padding: 0;
	    border: 0;
	    border: 1px solid #999;
	    width: 100%;
	}

	.Table-Normal tbody tr td {
	    margin: 0;
	    padding: 4px 8px;
	    border: 0;
	    border: 1px solid #999;
	}

	.Table-Normal tbody tr:nth-child(2) {
	    background-color: #EEE;
	}
	/* Tables */


</style>

@section('content')

{{Form::open(['id' => 'formq'])}}
{{Form::textarea('query', '', array('cols'=>'60', 'rows'=>'1', 'id' => 'query'))}} 



 {{Form::submit('Ejecutar', ['class'=>'btn btn-warning form-control', 'id' => 'ejecutar'])}}

<div id="table">
	
</div>

@stop


@section('javascript')

<script type="text/javascript">
	$(document).ready(function()
	{

		$('#formq').bind('submit',function ()
		{
	        $.ajax(
	        {
	            type: 'POST',
	            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
	            processData: false,
	            contentType: false,
	            url: '/consultas/db/query',
	            beforeSend: function()
	            {
	                 $('#table').html('Cargando... <span class="glyphicon glyphicon-refresh spin"></span>');
	            },
	            success: function (data)
	            {


	            	$('#table').html(data);

	            }
	          
	        });
	        return false;

		});

	})


</script>

@stop
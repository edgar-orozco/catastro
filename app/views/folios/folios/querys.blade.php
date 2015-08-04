@extends('layouts.default')



@section('content')

{{Form::open(['id' => 'formq'])}}
{{Form::textarea('query', '', array('cols'=>'60', 'rows'=>'1', 'id' => 'query'))}} 

<br>

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
@extends('layouts.default')

@section('styles')

.panel{
       	max-width: 600px; / change according to your requirement/
}
.center {
     float: none;
     margin-left: auto;
     margin-right: auto;
}
@stop

@section('content')

	<div class="panel panel-default center">
  		<div class="panel-heading">Apertura de Caja</div>

  		<div class="panel-body">
  		{{Form::open(['action'=>'Cajas_CajasController@create'])}}
	  		<div class="row">
			 	<div class="col-md-6"><h4>Usuario: Delta Castro D74</h4></div>
			  	<div class="col-md-6"><h4>Fecha: <?php echo date('d/m/y'); ?></h4></div>

			</div>
			<br>

	  		<div class="input-group">
	  			<span class="input-group-addon">$</span>
	  				{{Form::text('monto_inicial', null, ['class'=>'form-control', 'placeholder'=>'Monto inical', 'required'=>false])}}
	  				<span class="input-group-addon">.00</span>
	  		</div>
	  		<br>
	  		<button class="btn btn-primary" type="submit">
                    <i class="glyphicon glyphicon-arrow-right"></i>
                    Continuar
            </button>
            {{Form::Close()}}
  		</div>
	</div>
@stop
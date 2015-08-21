@extends('layouts.default')

@section('content')
    <div class="page-header">
        <h3>Configuracion</h3>
    </div>
<div class="panel panel-default">

	<div class="panel-heading">

		<h4 class="panel-title">Configuraciones Basicas</h4>

	</div>

	<div class="panel-body">
		{{Form::open()}}
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('salario_minimo','Salario Minimo Anual')}}
					<div class="input-group">
						<span class="input-group-addon">$</span>
						{{Form::text('salario_minimo', $conf->salario_minimo, ['class'=>'form-control'])}}
					 </div>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('valor_urbano','Costo de Folios Urbanos')}}
					<div class="input-group">
						{{Form::text('valor_urbano', $conf->salario_folio_urbano, ['class'=>'form-control'])}}
						 <span class="input-group-addon">S.M.G.V.</span>
					 </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('valor_rustico','Costo de Folios Rusticos')}}
					<div class="input-group">
						{{Form::text('valor_rustico', $conf->salario_folio_rustico, ['class'=>'form-control'])}}
					 	<span class="input-group-addon">S.M.G.V.</span>
					 </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('año_folio','Año folio COREVAT')}}
					{{Form::text('año_folio', $conf->ano_folio, ['class'=>'form-control'])}}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('director_catastro','Director de Catastro')}}
					{{Form::text('director_catastro', $conf->director_catastro, ['class'=>'form-control'])}}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('director_general','Director General de Catastro y Ejecucion Fiscal')}}		
					{{Form::text('director_general',  $conf->director_general, ['class'=>'form-control'])}}
				</div>
			</div>			
			<div class="col-md-12">
				<div class="form-group">
					{{Form::label('frase_anual','Frase anual de Oficio')}}
					{{Form::text('frase_anual',  $conf->frase_anual, ['class'=>'fecha form-control'])}}
				</div>
			</div>
            <div class="row">
                <div class="col-md-6">
                    {{Form::submit('Guardar', ['class'=>'btn btn-block btn-success'])}}
                </div>
            </div>
		</div>
		{{Form::close()}}
	</div>
</div>

@stop
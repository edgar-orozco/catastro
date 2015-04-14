<div class="page-header">
	<h2>
		Tomas Agua
    </h2>
</div>

<div class="panel-body">
		{{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
		<div class="row">
			<div class="col-md-3">

				<div class="form-group">
				{{Form::label('Lmedidor_instalado','Medidor Instalado')}}
				<br>
					Si {{Form::radio('medidor_instalado', 'Si')}}
					No {{Form::radio('medidor_instalado', 'No')}}
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('Lnum_medidor', 'Numero de medidor')}}
					{{Form::text('num_medidor',$predios[0]->tipo_propiedad, ['class'=>'form-control', 'required'])}}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('Lnum_contrato','Numero de contrato')}}
					{{Form::text('num_contrato','',['class'=>'form-control','required'])}}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('Ltipo_toma','Tipo Toma')}}
					{{Form::select('tipo_toma',  $tta, null, ['class' => 'form-control'])}}

				</div>
			</div>

		</div>
	</div>


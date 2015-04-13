
<div class="panel panel-default">
        <!-- Default panel contents -->
        

	<div class="panel-heading">Datos Complementarios</div>

	      <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Entidad</th>
                <th>Municipio</th>
            </tr>
        </thead>
        <tbody>
            <tr>    
                @foreach($predios as $predio)
                <th scope="row">{{$predio->clave_catas}}</th>
                <td>{{$predio->nom_ent}}</td>
                <td>{{$predio->nombre_municipio }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

{{Form::open(array('url' => 'guardar-predios', 'method' => 'POST', 'name' => 'formPredios', 'id' => 'formPredios'))}}
	<div class="panel-body">
		{{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Ltipo_predio','Tipo Predio')}}		
					{{Form::select('tipo_predio', ['U' => 'Urbano','R' => 'Rústico'], null, ['id'=>'tipo_predio', 'class' => 'form-control'])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Ltipo_propiedad', 'Tipo Propiedad')}}
					{{Form::text('tipo_propiedad',$predios[0]->tipo_propiedad, ['class'=>'form-control', 'id'=>'tipo_propiedad', 'required'])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Lniveles','Niveles')}}
					{{Form::number('niveles','',['class'=>'form-control bfh-number','required', 'id'=>'niveles', 'min' => '1' ])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Lfolio','Folio')}}
					{{Form::text('folio','',['class'=>'form-control','required', 'id'=>'folio'])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Lsuperficie_terreno','Superficie Terreno')}}
					{{Form::text('superficie_terreno','',['class'=>'form-control','required', 'id'=>'superficie_terreno'])}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::label('Luso_construccion','Uso Connstrucción')}}
					{{Form::select('uso_construccion',  $tuc, null, ['id'=>'uso_construccion', 'class' => 'form-control'])}}
					
				</div>
			</div>
		</div>
	</div>

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

<button type="submit" class="btn btn-primary next">
	Siguiente
	<i class="glyphicon glyphicon-chevron-right"></i>
</button>

{{Form::close()}}

@section('javascript')


<script type="text/javascript">

$('#formPredios').bind('submit',function () 
    {
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/guardar-predios',

            success: function (data) 
            {


            }
        });
        return false;
    });

</script>

@append

	
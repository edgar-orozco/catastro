
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


<div class="panel-body">
	{{ Form::open(array('url' => 'guardar-predios', 'method' => 'POST', 'name' => 'formPredios', 'id' => 'formPredios')) }}
		{{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('Lcuenta_agua','Cuenta con Agua')}}
					{{Form::text('cuenta_agua',null,['class'=>'form-control', 'required', 'id'=>'cuenta_agua' ])}}
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('Ltipo_predio','Tipo Predio')}}		
					{{Form::select('tipo_predio', ['U' => 'U','R' => 'R'], null, ['id'=>'tipo_predio', 'class' => 'form-control'])}}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('Ltipo_propiedad', 'Tipo Propiedad')}}
					{{Form::text('tipo_propiedad','', ['class'=>'form-control', 'id'=>'tipo_propiedad', 'required'])}}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('Lniveles','Niveles')}}
					{{Form::text('niveles','',['class'=>'form-control','required', 'id'=>'niveles'])}}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('Lfolio','Folio')}}
					{{Form::text('folio','',['class'=>'form-control','required', 'id'=>'folio'])}}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('Lsuperficie_terreno','Superficie Terreno')}}
					{{Form::text('superficie_terreno','',['class'=>'form-control','required', 'id'=>'superficie_terreno'])}}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{{Form::label('Luso_construccion','Uso Connstrucción')}}
					{{Form::select('uso_construccion',  $tuc, null, ['id'=>'uso_construccion', 'class' => 'form-control'])}}
					
				</div>
			</div>
			
		
		</div>
		<button type="submit" class="btn btn-primary next">
            Siguiente
        	<i class="glyphicon glyphicon-chevron-right"></i>
        </button>
	{{Form::close()}}
</div>






@section('javascript')

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
            beforeSend: function()
            {
                alert("mandando petición");
            },
            success: function (data) 
            {               
                alert("guardado correcto");
                
               
            


            }
        });
        return false;
    });

</script>

@append

	

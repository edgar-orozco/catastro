{{ HTML::style('js/jquery/jquery-ui.css') }}
<div class="page-header">
	<h2>
		Tomas Agua
    </h2>
</div>
{{Form::open(array('url' => 'guardar-agua', 'method' => 'POST', 'name' => 'formAgua', 'id' => 'formAgua'))}}
<div class="panel-body">
		{{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
		{{Form::text('estado',$estado,['id'=>'estado', "hidden" ])}}
    {{Form::text('municipio',$municipio,['id'=>'municipio', "hidden" ])}}
    {{Form::text('clave_cata',$clave_catas,['id'=>'clave_cata', "hidden" ])}}
		<div class="row">
			<div class="col-md-3">

				<div class="form-group">
				{{Form::label('Lmedidor_instalado','Medidor Instalado')}}
				<br>
					Si {{Form::radio('medidor_instalado', 'Si')}}
					No {{Form::radio('medidor_instalado', 'No', 'checked')}}
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

<div>
    {{Form::label('id_p','Nombre')}}
    <!--SI "TRAE" ALGO LA VARIABLE $nombrec -->
    @if(!empty($nombrec))
    {{Form::text('nombrec',$nombrec, ['tabindex'=>'1','id' => 'nombrec','required' => 'required', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.nombrec'] )}}
    @endif
    <!--SI "NO" TRAE ALGO LA VARIABLE $nombrec -->
    @if(empty($nombrec))
    {{Form::text('nombrec',null, ['tabindex'=>'1','id' => 'nombrec', 'required' => 'required','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.nombrec'] )}}
    @endif
  
    {{Form::text('id_p',null, ['id' => 'response','hidden'])}}
    {{$errors->first('id_p', '<span class=text-danger>:message</span>')}}

</div>

		</div>
	</div>
<button type="submit" class="btn btn-primary next">
	Siguiente
	<i class="glyphicon glyphicon-chevron-right"></i>
</button>

{{Form::close()}}

@section('javascript')
<script>

$('#formAgua').bind('submit',function ()
    {
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/guardar-agua',

            success: function (data)
            {

            }
        });
        return false;
    });
</script>

<script>
    $(function () {
        $("#nombrec").autocomplete({
            source: "/search/autocomplete1",
            minLength: 1,
            select: function (event, ui) {
                $('#response').val(ui.item.id);
            }
        });
    });
</script>

@append

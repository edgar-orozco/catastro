{{ HTML::style('js/jquery/jquery-ui.css') }}

<?php
if(count($tomas_agua)=='')
    {
         $checekdn='checked';
    }
 foreach ($tomas_agua as $ta ) {
   $gid_p=$ta['gid'];
   $medidor_instalado=$ta['medidor_instalado'];
    $num_medidor=$ta['num_medidor'];
    $num_contrato=$ta['num_contrato'];
    $id_usuariotoma=$ta['id_usuariotoma'];

    if($medidor_instalado==1)
    {
        $checkeds='checked';
    }
    if($medidor_instalado=='')
    {
         $checekdn='checked';
    }
}
$nombress=personas::where('id_p', '=', $id_usuariotoma)->pluck('nombres');
$apellidop=personas::where('id_p', '=', $id_usuariotoma)->pluck('apellido_paterno');
$apellidom=personas::where('id_p', '=', $id_usuariotoma)->pluck('apellido_materno');
$nombre_p=$nombress.' '.$apellidop.' '.$apellidom;
?>

{{Form::open(array('url' => 'guardar-agua', 'method' => 'POST', 'name' => 'formAgua', 'id' => 'formAgua'))}}
<div class="panel-body">
        {{Form::text('gid_p',$gid_p,['id'=>'gid_p', "hidden" ])}}
		{{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
		{{Form::text('estado',$estado,['id'=>'estado', "hidden" ])}}
    {{Form::text('municipio',$municipio,['id'=>'municipio', "hidden" ])}}
    {{Form::text('clave_cata',$clave_catas,['id'=>'clave_cata', "hidden" ])}}
		<div class="row">
			<div class="col-md-3">

				<div class="form-group">
				{{Form::label('Lmedidor_instalado','Medidor Instalado')}}
				<br>
					Si {{Form::radio('medidor_instalado', '1', $checkeds)}}
					No {{Form::radio('medidor_instalado', '0', $checekdn)}}
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('Lnum_medidor', 'Numero de medidor')}}
					{{Form::text('num_medidor',$num_medidor, ['class'=>'form-control'])}}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('Lnum_contrato','Numero de contrato')}}
					{{Form::text('num_contrato',$num_contrato,['class'=>'form-control'])}}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{Form::label('Ltipo_toma','Tipo Toma')}}
					{{Form::select('tipo_toma',  $tta, $id_tipotoma, ['class' => 'form-control'])}}

				</div>
			</div>


		</div>
	</div>
<div>
    {{Form::label('personasp','Nombre Persona:')}}
   {{Form::text('personasp',$nombre_p, ['tabindex'=>'1','id' => 'personasp', 'autofocus'=> 'autofocus', 'style'=>'width: 321px'] )}}
    <a data-toggle="modal"  data-target="#Nuevo1" href="/personas/p2" class="btn btn-primary" id="nuevo">NUEVA PERSONA</a>
    {{Form::text('id_p',$id_usuariotoma, ['id' => 'response2','hidden'])}}
    {{$errors->first('id_p', '<span class=text-danger>:message</span>')}}
</div>
<br/><br/>
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
                $('.mensaje').html('<div class="alert alert-success">El registro se actualizo correctamente.</div>');
            }
        });
        return false;
    });
</script>
<script>
    //autocomplete
    $(function () {
        $("#personasp").autocomplete({
            source: "/search/autocomplete1",
            minLength: 1,
            select: function (event, ui) {
                $('#response2').val(ui.item.id);
            }
        });
    });
    


</script>


@append
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="Nuevo1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>
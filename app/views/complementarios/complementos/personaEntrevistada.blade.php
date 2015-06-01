<?php
foreach ($entrevistados as $ev ) {
     $id_pe=$ev['id_p'];
}

$nombresss=personas::where('id_p', '=', $id_pe)->pluck('nombres');
$apellidope=personas::where('id_p', '=', $id_pe)->pluck('apellido_paterno');
$apellidome=personas::where('id_p', '=', $id_pe)->pluck('apellido_materno');
$nombre_pe = $nombresss.' '.$apellidope.' '.$apellidome;
?>

{{ HTML::style('js/jquery/jquery-ui.css') }}

{{Form::open(array( 'method' => 'POST',  'id' => 'formEntrevista'))}}
<div class="input-group">
    {{ Form::hidden('clave_cata',$clave_catas) }}
    {{ Form::hidden('gid_predio',$gid) }}
    {{ Form::hidden('entidad',$estado) }}
    {{ Form::hidden('municipio',$municipio) }}
    {{ Form::hidden('id_p',$id_pe) }}
</div>

<div>
    {{Form::text('nombrec',$nombre_pe, ['tabindex'=>'1','id' => 'nombrec','autofocus'=> 'autofocus', 'style'=>'width: 321px'] )}}
    <a data-toggle="modal"  data-target="#Nuevo" href="/personas/p" class="btn btn-primary" id="nuevo">NUEVA PERSONA</a>
    {{Form::text('id_p',$id_pe, ['id' => 'response','hidden'])}}
    {{$errors->first('id_p', '<span class=text-danger>:message</span>')}}
</div>
<br/><br/><br/>
<button type="submit" class="btn btn-primary next">
    Siguiente
    <i class="glyphicon glyphicon-chevron-right"></i>
</button>
{{Form::close()}}

@section('javascript')
<script type="text/javascript">
//Guardar
    $('#formEntrevista').bind('submit', function ()
    {
        $.ajax(
                {
                    type: 'POST',
                    data: new FormData(this), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
                    processData: false,
                    contentType: false,
                    url: '/guardar-entrevista',
                    success: function (data)
                    {


                    }
                });
        return false;
    });

</script>
<script>
    //autocomplete
    $(function () {
        $("#nombrec").autocomplete({
            source: "/autocomplete",
            minLength: 1,
            select: function (event, ui) {
                $('#response').val(ui.item.id);
            }
        });
    });



</script>
<script>
    $(document).ready(function () {
        $('#refresh').click(function () {
            location.reload();
        });
    });

</script>  
@append

<!-- Modal -->
<div class="modal fade" id="Nuevo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>
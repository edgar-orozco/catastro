{{ HTML::style('js/jquery/jquery-ui.css') }}

{{Form::open(array( 'method' => 'POST',  'id' => 'formEntrevista'))}}
<div class="input-group">
            {{ Form::hidden('clave_cata',$clave_catas) }}
            {{ Form::hidden('gid_predio',$gid) }}
            {{ Form::hidden('entidad',$estado) }}
            {{ Form::hidden('municipio',$municipio) }}
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
    <a data-toggle="modal"  data-target="#Nuevo" >
        <span class="glyphicon glyphicon-plus" style="margin-left: 365px;"></span>
    </a>
    {{Form::text('id_p',null, ['id' => 'response','hidden'])}}
    {{$errors->first('id_p', '<span class=text-danger>:message</span>')}}

</div>
<div class="col-md-6">
<div class="form-group">
 <button type="submit" class="btn btn-primary next">
            Siguiente
            <i class="glyphicon glyphicon-chevron-right"></i>
        </button>
    </div>
</div>

{{Form::close()}}
<!-- Modal -->
<div class="modal fade" id="Nuevo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @include('complementarios.complementos.personas')
        </div>
    </div>
</div>

@section('javascript')
<script type="text/javascript">
//Guardar
$('#formEntrevista').bind('submit',function () 
    {
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
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
            source: "/search/autocomplete1",
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

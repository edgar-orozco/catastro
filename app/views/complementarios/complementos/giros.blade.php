<style>
    #map-canvas {
        height: 30%;
        margin: 0px;
        padding: 0px
    }
    .uncheck
    {
        /*display: none;*/
        position: absolute;
        z-index: 7;
        opacity: -0.5;
        /* opacity: 1.5;*/
    }
   .column ul{
        width:760px;
        overflow:hidden;
        border-top:1px solid #ccc;
    }
    .column li{
        line-height: 1.5em;
        float: left;
        display: inline;
        width: 47.333%;
        margin-top: 5px;
        margin-left: 17px;
    }
    .list-unstyled
    {
        border-top:none;
    }
      #btn-guardar
    {
        margin-left: 250px;
        margin-top: 52px;
    }

</style>

@section('javascript')
    
    <script type="text/javascript">

        $('#giroForm').bind('submit',function () 
            {   
                $.ajax(
                {
                    type: 'POST',
                    data: new FormData( this ), 
                    processData: false,
                    contentType: false,
                    url: '/cargar-complementos/guardar-giros',
                    beforeSend: function()
                    {
                        
                    },
                    success: function (data) 
                    {               
                        
                    }
                });
                return false;
            });
    </script>
    



@append


{{ Form::open(array('url'=>'/cargar-complementos/guardar-giros', 'id' => 'giroForm'))}}

<div class="input-group">
    {{ Form::hidden('clave_cata',$clave_catas) }}
    {{ Form::hidden('gid_predio',$gid) }}
    {{ Form::hidden('entidad',$estado) }}
    {{ Form::hidden('municipio',$municipio) }}
</div>

<?php
$cat = array();
foreach ($giros as $catal) {
    $cat[] = $catal->id_tipogiro;
}

$asocia = array();
foreach ($girosasociados as $asoc) {
    $asocia[] = $asoc->id_giroconstruccion;
}
?>
@foreach($predios as $predio)
{{ Form::hidden('gid',$predio->gid) }}
@endforeach
@foreach($asocia as $asoc)
{{Form::hidden('select[]',$asoc) }}
@endforeach
<ul class="list-unstyled column">  
    @foreach($giros as $row)
    <?php
    if (in_array($row->id_tipogiro, $asocia)) {
        $css = 'active';
        $input = "<label class='btn btn-sm btn-default uncheck'>$row->descripcion<input type='checkbox' name='eliminar[]' value=$row->id_tipogiro ></label>";
    } else {
        $css = '';
        $input = '';
    }
    ?>
    <li class="column"><?php echo $input; ?>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default <?php echo $css ?>">{{$row->descripcion}}
                <input type='checkbox'  name='giros[]' value="{{$row->id_tipogiro}}">
            </label>
        </div>
    </li>
    @endforeach

</ul>
<br><br><br><br><br><br><br><br>
<div class="col-md-6">
<div class="form-group">
 <button type="submit" class="btn btn-primary next">
            Siguiente
            <i class="glyphicon glyphicon-chevron-right"></i>
        </button>
    </div>
</div>
{{ Form::close() }}
<br/>
<hr>

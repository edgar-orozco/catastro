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

        /*        opacity: 1.5;*/
    }
    .column ul{
        width:760px;
        overflow:hidden;
        border-top:1px solid #ccc;
    }
    .column li{
        line-height:1.5em;       
        float:left;
        display:inline;
        width:33.333%;
        margin-top: 5px;
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

        $('#servicioForm').bind('submit',function () 
            {   
                $.ajax(
                {
                    type: 'POST',
                    data: new FormData( this ), 
                    processData: false,
                    contentType: false,
                    url: '/cargar-servicios',
                    beforeSend: function()
                    {
                        
                    },
                    success: function (data) 
                    {               
                        
                         //Se obtiene el elemento table
                        

                       
                    


                    }
                });
                return false;
            });
    </script>
    



@append
{{ Form::open
        (
                array('url'=> '/cargar-servicios', 'id' => 'servicioForm')
        )
}}

<div class="input-group">
    {{ Form::hidden('clave_cata',$clave_catas) }}
    {{ Form::hidden('gid_predio',$gid) }}
    {{ Form::hidden('entidad',$estado) }}
    {{ Form::hidden('municipio',$municipio) }}
</div>

<ul class="list-unstyled column">
    <?php
    $catas = array();
    foreach ($cat as $cata) {
     $catas[] = $cata->id_tiposervicio;
    }
    print_r($catas);
    
    $asocia = array();
    foreach ($asociados as $asoc) {
        $asocia[] = $asoc->id_tiposervicio;
    }
    ?>

    @foreach($predios as $predio)
    {{ Form::hidden('gid',$predio->gid) }}
    @endforeach

   
    @foreach($asociados as $asoc)
    {{Form::hidden('serv[]',$asoc) }}
    @endforeach
<?php 
    
    ?>
    @foreach($cat as $row)<?php
    if (in_array($row->id_tiposervicio, $asocia)) {
        $css = 'active';
        $input = "<label class='btn btn-sm btn-default uncheck'>$row->descripcion<input type='checkbox' name='fuera[]' value=$row->id_tiposervicio ></label>";
    } else {
        $css = '';
        $input = '';
    }
    ?>
    <?php
//    $count = count($cat);
//    $count;
//    $li = $count / 3;
//    $li = round($li);
//    echo $li;
    ?>
    <li> <?php echo $input; ?>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default <?php echo $css ?>">{{$row->descripcion}}
                <input type='checkbox' name='opcion[]' value="{{$row->id_tiposervicio }}">
            </label>
        </div>
    </li>
    @endforeach
</ul>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="form-group">
 <button type="submit" class="btn btn-primary next">
            Siguiente
            <i class="glyphicon glyphicon-chevron-right"></i>
        </button>
    </div>
{{ Form::close() }}

<br/>
<hr>



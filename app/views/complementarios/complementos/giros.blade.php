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
{{ Form::open
        (
                array('url'=>'/cargar-complementos/guardar-giros',)
        )
}}
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
{{ Form::submit('Guardar', array('class' => 'btn btn-primary','id'=>'btn-guardar')) }}
{{ Form::close() }}
<br/>
<hr>

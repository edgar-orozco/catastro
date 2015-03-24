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
@stop
{{ Form::open
        (
                array('url'=> '/cargar-servicios',)
        )
}}

<ul class="list-unstyled column">
    <?php
    $catas = array();
    foreach ($cat as $cata) {
        $catas[] = $cata->id;
    }
    $asocia = array();
    foreach ($asociados as $asoc) {
        $asocia[] = $asoc->id_tiposerviciopredio;
    }
    ?>

    @foreach($predios as $predio)
    {{ Form::hidden('gid',$predio->gid) }}
    @endforeach

    @foreach($asocia as $asoc)
    {{Form::hidden('serv[]',$asoc) }}
    @endforeach

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
{{ Form::submit('Guardar', array('class' => 'btn btn-primary','id'=>'btn-guardar')) }}
{{ Form::close() }}

<br/>
<hr>



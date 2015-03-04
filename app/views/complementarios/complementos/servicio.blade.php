<style>
    #map-canvas {
        height: 30%;
        margin: 0px;
        padding: 0px
    }
</style>
{{ Form::open
        (
                array('url'=> '/cargar-servicios',)
        )
}}

<ul class="list-unstyled">
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
  
    @foreach($cat as $row)      
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default <?php
                   if (in_array($row->id, $asocia)) {
                       echo 'active';
                   }
                   ?> ">{{$row->descripcion}}
                <input type=checkbox name='opcion[]' value="{{$row->id }}" >  
            </label>
        </div>
    </li>
    @endforeach    
</ul>
{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
<br/>
<hr>
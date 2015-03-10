<style>
    #map-canvas {
        height: 30%;
        margin: 0px;
        padding: 0px
    }
</style>
{{ Form::open
        (
                array('url'=> '/cargar-giros',)
        )
}}

<?php


?>
<ul class="list-unstyled">  
      @foreach($giros as $row)
      <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">{{$row->descripcion}}
                <input type='checkbox'  name='opcion[]' value="{{$row->id_tipogiro}}">
            </label>
        </div>
    </li>
    @endforeach
 
</ul>
{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
<br/>
<hr>

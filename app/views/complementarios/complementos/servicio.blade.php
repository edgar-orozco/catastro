<style>
    #map-canvas {
        height: 30%;
        margin: 0px;
        padding: 0px
    }
</style>
@section('javascript')
<script>
    $(document).ready(function () {
        jAlert('This is a custom alert box', 'Alert Dialog');
        var d = document.formulario;
//Checkbox seleccionar todos
        $("input[name=checktodos]").change(function () {
            $('input[type=checkbox]').each(function () {
                if ($("input[name=checktodos]:checked").length == 1){
                this.checked = true;
                        d.fuera[].disabled = false;
                        d.date1.disabled = false;
            } else {
            this.checked = false;
                    d.fuera[].disabled = true;
                    d.date1.disabled = true;
                    }
        });
    });
            });
</script>
@stop
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

    @foreach($cat as $row)<?php
  
    if (in_array($row->id, $asocia)) {
        $css = 'active';
        $input = "<input type='checkbox' name='fuera[]' value=";?><?php echo $row->id .">";
    } else {
        $css = '';
        $input = '';
    }
    ?>
    <li><?php echo $input; ?>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">

            <label class="btn btn-sm btn-default  <?php echo $css ?>">{{$row->descripcion}}
                <input type='checkbox'  name='opcion[]' value="<?php echo $row->id; ?> ">

            </label>

        </div>
    </li>
    @endforeach
</ul>
{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
<br/>
<hr>


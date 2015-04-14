<html>
    <head>

    </head>
    <body>
        {{ Form::open
 (
array('url'=>'/consultas')
 )
        }}
        {{ Form::text('clave', null) }}
        {{ Form::submit('buscar') }}
        {{ Form::close() }}
        <?php
        $count = count($item);
        if ($count == 1) {
            ?>
            <div class="panel-body">
                <div class="alert alert-danger"> Buscar Datos por clave</div>
            </div>
            <?php
        } elseif ($count > 2) {
            $search = array('(', ')');
            $replace = " ";
            $item = str_replace($search, $replace, $item);
            ?> <label>Gid:{{$item[0] }}</label> 
            <br>
            <label>Clave:{{$item[1] }}</label> 
            <br>
            <label>Geom:{{$item[2] }}</label> 
            <br>
            <label>xMin:{{$item[3] }}</label> 
            <br>
            <label>yMin:{{$item[4] }}</label> 
            <br>
            <label>xMax:{{$item[5] }}</label> 
            <br>
            <label>yMax:{{$item[6] }}</label> 
            <br>
        <?php } ?>
    </body>
</html>

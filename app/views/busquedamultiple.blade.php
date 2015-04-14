<html>
    <head>

    </head>
    <body>
        {{ Form::open
 (
array('url'=>'/consultasmultiples')
 )
        }}
        {{ Form::text('dato', null) }}
        {{Form::select('busquedapor',  array('municipio' => 'Municipio','Localidades' => 'Localidades','Cuenta' => 'Cuenta'))}}
        {{ Form::submit('buscar') }}
        {{ Form::close() }}
<?php

//var_dump($mult);

?>
 <label>Gid:</label> 
            <br>
            <label>Clave:</label> 
            <br>
            <label>Geom:</label> 
            <br>
            <label>xMin:</label> 
            <br>
            <label>yMin:</label> 
            <br>
            <label>xMax:</label> 
            <br>
            <label>yMax:</label> 
            <br>
    </body>
</html>

<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#cbomunicipios").change(function () {
                    var mun = $(this).val();
                    if (mun > 0)
                    {
                        var datos = {
                            idmun: $(this).val()
                        };
                        console.log(datos);
                        $.post("/localidades", datos, function (localidades) {
                            var $cbolocalidades = $("#cbolocalidades");
//                            console.log($cbolocalidades);
                            $cbolocalidades.empty();
                            $.each(localidades, function (index, localidad) {

                                // agregamos opciones al combo
                                $cbolocalidades.append("<option value='" + localidad + "'>" + localidad + "</option>");
                            });
                        }, 'json');
                    }
//                    else
//                    {
//                        // limpiamos el combo e indicamos que se seleccione un país
//                        var $cbolocalidades = $("#cbolocalidades");
//                        $cbolocalidades.empty();
//                        $cbolocalidades.append("<option>Seleccione un municipio</option>");
//                    }
                });
            });
        </script>
    </head>
    <body>
        <span>Formulario por busquedas</span>   

        {{ Form::open(array('url'=>'/consultasmultiples'))}}
        <label>Municipio</span>
        <select name="municipio" id="cbomunicipios" class="form-control" autofocus="autofocus">
            <option value="0">Seleccione un Municipio</option>
            <?php
            foreach ($municipios as $mun) {
                ?>
                <option value="<?php echo $mun->municipio ?>"><?php echo $mun->nombre_municipio ?></option>
            <?php } ?>
        </select>
        <br>
        <label>Localidad</span>
            <select name="localidad" id="cbolocalidades" class="form-control" autofocus="autofocus">
                <option value="0">Seleccione una Localidad</option>
            </select>
            <label>Limite de Registros</span>
                <select name="paginador" class="form-control" autofocus="autofocus">
                    <option value="0">0</option>
                    <option value="10">10</option>
                    <option value="200">20</option>
                    <option value="300">30</option>
                    <option value="400">40</option>
                    <option value="500">50</option>
                    <option value="10">60</option>
                    <option value="10">70</option>
                    <option value="10">80</option>
                    <option value="10">90</option>
                    <option value="10">100</option>

                </select>
                {{ Form::submit('buscar') }}
                {{ Form::close() }}
                <?php
                $count = count($datos);
                if ($count == 1) {
                    ?>
                    <div class="panel-body">
                        <div class="alert alert-danger"> Buscar Datos por parametros</div>
                    </div>
                    <?php
                } elseif ($count > 2) {

//
                    $search = array('(', ')');
                    $replace = " ";
                    $final = str_replace($search, $replace, $datos);
//            echo"<pre>";
//            var_dump($final);
//            echo"</pre>";
//            echo $datos[0][0];
                    foreach ($datos as $row) {

                        $cadena = $row[0][0];
                        $search = array('(', ')');
                        $replace = " ";
                        $row1 = str_replace($search, $replace, $cadena);
                        $row2 = $row[0][6];
                        $row2 = str_replace($search, $replace, $row2);
                        ?>
                        <br>
                        <br>
                        <label>Gid:{{$row1 }}</label> 
                        <br>
                        <label>Clave:{{$row[0][1]}}</label> 
                        <br>
                        <label>Geom:{{$row[0][2]}}</label> 
                        <br>
                        <label>xMin:{{$row[0][3]}}</label> 
                        <br>
                        <label>yMin:{{$row[0][4]}}</label> 
                        <br>
                        <label>xMax:{{$row[0][5]}}</label> 
                        <br>
                        <label>yMax:{{$row2}}</label> 

                        <br>
                        <?php
                    }
                }
               ?>

                        </body>
                        </html>

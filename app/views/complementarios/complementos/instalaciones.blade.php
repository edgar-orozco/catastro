
{{ Form::open(array( 'id' => 'instalaciones', 'url'=> '/agregar',)) }}
    <br/>
    
        <div class="input-group">
            {{ Form::hidden('id',$predios[1]->clave_catas) }}
        </div>
        
        <div class="col-md-5">
            <div class="form-group">
                {{Form::select('instalaciones', $catalogo, null, ['id'=>'instalaciones','class'=>'form-control'])}}
            </div>
        </div>  

        <div class="col-md-6">
            <div class="form-group">
                {{Form::submit('Agregar', array('class' => 'btn btn-primary'))}}
            </div>
        </div>
        
{{ Form::close() }}

<table class="table">
    <thead>
        <tr>
<!--            <th>ID</th>
            <th>Clave</th> -->
            <th>Tipos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $url = URL::current();
        $new = explode("/", $url);
//        var_dump($new);
        $count = count($new);
        $count = $count - 1;
        $clave=$new[$count];
        ?>
        @foreach($datos as $row)
        <tr>
           
            <td>{{$row->descripcion}}</td>
            <td nowrap>
                <!--borrar-->
                <a href="/cargar-complementose/{{$row->id_ie }}" class="btn btn-danger" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    <tfoot>
        
    
    </tfoot>
</table>

@section('javascript')

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

$('#instalaciones').bind('submit',function () 
    {   
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/agregar',
            beforeSend: function()
            {
                alert("mandando petición");
            },
            success: function (data) 
            {               
                alert("guardado correcto");
                 //Se obtiene el elemento table
                var tables = document.getElementById("table");
                //En caso de que exista, la eliminara.
                if (tables) tables.parentNode.removeChild(tables);
                
                
                //Se crea la tabla de predios dinamicamente
                for (i = 0; i < data.size; i++) 
                {
                    
                    var div = document.getElementById("div-table");
                    var x = document.createElement("TABLE");
                    x.setAttribute("id", "table");
                    x.setAttribute("class", "table");
                    div.appendChild(x);
                    var table = document.getElementById("table");
                    var header = table.createTHead();
                    var row = header.insertRow(0);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "<b>Tipos</b>";
                    cell =row.insertCell(1);
                    cell.innerHTML = "<b>Acciones<b>";
                    var tbody = table.appendChild(document.createElement('tbody'));
                    row = tbody.insertRow(0);
                    cell = row.insertCell(0);
                    cell.innerHTML=data.busqueda[0].clave_catas;
                    cell = row.insertCell(1);
                    cell.innerHTML=data.busqueda[0].clave_ori;
                    cell = row.insertCell(2);
                    var clave_catas = '<input type="text" name="hide_catas" id = "hide_catas" value="'+data.busqueda[0].clave_catas+'" hidden>';
                    var municipio = '<input type="text" name="hide_municipio" id = "hide_municipio" value="'+document.getElementById('municipio').value+'" hidden>'
                    cell.innerHTML='<a href="/cargar-complementos/'+data.busqueda[0].gid+'" class="btn btn-warning nuevo" title="Editar Predio"> <span class="glyphicon glyphicon-pencil"></span></a>'+clave_catas+municipio;
                    $('.mensaje').html('');

                }

               
            


            }
        });
        return false;
    });

</script>

@append

{{ Form::open(array( 'id' => 'instalaciones')) }}
    <br/>
    
        <div class="input-group">
            {{ Form::hidden('clave_catas',$clave_cata) }}
            {{ Form::hidden('gid_predio',$gid) }}
            {{ Form::hidden('entidad',$estado) }}
            {{ Form::hidden('municipio',$municipio) }}
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
<div id="div-table" class="row">
<table class="table" id="table-instalaciones">
    <thead>
        <tr>
<!--            <th>ID</th>
            <th>Clave</th> -->
            <th>Tipos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
       
        @foreach($datos as $row)
        <tr>
           
            <td>{{$row->descripcion}}</td>
            <td>
                <!--borrar-->
                <a id="anchor-delete{{$row->id_ie}}" onclick="eliminar('{{$row->id_ie}}')" class="btn btn-warning eliminar" title="Editar Predio">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
        </tr>
        @endforeach
    <tfoot>
        
    
    </tfoot>
</table>
</div>

@section('javascript')


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

            },
            success: function (data) 
            {               

                 //Se obtiene el elemento table
                var table = document.getElementById("table-instalaciones");
                //En caso de que exista, la eliminara.
                             
                
                //Se crea la tabla de predios dinamicamente
                
                
                var tbody = table.getElementsByTagName('tbody')[0];
                row = tbody.insertRow();
                cell = row.insertCell(0);
                cell.innerHTML=data.instalaciones;
                cell = row.insertCell(1);
                var id_ie = '<input type="text" name="hide_idie" id = "hide_idie" value="'+data.id_ie+'" hidden>';
                cell.innerHTML='<a id="anchor-delete'+data.id_ie+'" onclick="eliminar('+data.id_ie+')" data-eliminar-type="'+data.id_ie+'" class="btn btn-warning eliminar" title="Editar Predio"> <span class="glyphicon glyphicon-remove"></span></a>';
                

                

               
            


            }
        });
        return false;
    });


function eliminar(id_ie)
{
    
   

    $.ajax(
        {
            type: 'POST',
            data: {id_ie:id_ie}, //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            url: '/eliminar-inst',
            beforeSend: function()
            {
                alert("mandando petición");
            },
            success: function (data) 
            {               
                alert("guardado correcto");
                 //Se obtiene el elemento table
                var td = $('#anchor-delete'+data.id_ie).parent();
                var tr = td.parent().remove();


            }
        });
}



</script>

@append
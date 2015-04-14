
<div class="mensaje">
            
        </div>
<div class="panel-body" id="panel-construccion" hidden>
    {{ Form::open(array('url' => 'guardar-construccion', 'method' => 'POST', 'name' => 'formConstruccion', 'id' => 'formConstruccion')) }}

        {{Form::text('gid',$gid,['id'=>'gid', "hidden" ])}}
        {{Form::text('estado',$estado,['id'=>'estado', "hidden" ])}}
        {{Form::text('municipio',$municipio,['id'=>'municipio', "hidden" ])}}
        {{Form::text('clave_cata',$clave_catas,['id'=>'clave_cata', "hidden" ])}}
        {{Form::text('gid_construccion','',['id'=>'gid_construccion', "hidden" ])}}

        <div class="row">
        <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lnivel','Nivel:')}}
                    {{Form::number('nivel',1,['class'=>'form-control', 'required', 'id'=>'nivel', 'min' => '1' ])}}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lsuperficie_construccion', 'Superficie:')}}
                    {{Form::number('superficie_construccion', 1, ['id'=>'superficie_construccion','class'=>'form-control', 'min' => '1'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Ledad_construccion','Edad:')}}
                    {{Form::number('edad_construccion', 1, ['id'=>'edad_construccion','class'=>'form-control', 'min' => '1'])}}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Luso_construccion','Uso:')}}
                    {{Form::select('uso_construccion', $tuc, ['seleccione'], ['id'=>'uso_construccionc', 'class' => 'form-control', 'required'])}}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lclase_construccion', 'Clase:')}}
                    {{Form::select('clase_construccion', $tcc, null, ['id'=>'clase_construccion', 'class' => 'form-control', 'required'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Ltecho_construccion','Techo:')}}
                    {{Form::select('techo_construccion', $ttc, null, ['id'=>'techo_construccion', 'class' => 'form-control', 'required'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lestado_conservacion','Estado:')}}
                    {{Form::select('estado_conservacion', $tec, null, ['id'=>'estado_conservacion', 'class' => 'form-control', 'required'])}}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lmuro_construccion','Muros:')}}
                    {{Form::select('muro_construccion', $tmc, null, ['id'=>'muro_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lpiso_construccion', 'Pisos:')}}
                    {{Form::select('piso_construccion', $tpic, null, ['id'=>'piso_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lpuerta_construccion','Puertas:')}}
                    {{Form::select('puerta_construccion', $tpuc, null, ['id'=>'puerta_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('Lventana_construccion','Ventanas:')}}
                    {{Form::select('ventana_construccion', $tvc, null, ['id'=>'ventana_construccion', 'class' => 'form-control'])}}
                </div>
            </div>
               
                
                
        </div>
        <button type="submit" class="btn btn-primary">
            Agregar
            <i class=""></i>
        </button>
    {{Form::close()}}
</div>

{{form::button('Nuevo', ['class'=>'btn btn-primary', 'id' => 'const-nuevo'])}}
<div id="div-table" class="row">
<table class="table" id="table-construcciones">
    <thead>
        <tr>
            <th>Nivel</th>
            <th>Superficie Construcción</th>
            <th>Clase Construcción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
       
        @foreach($datos_construcciones as $row)
        <tr>

            <td>{{$row->nivel}}</td>
            <td>{{$row->sup_const}}</td>
            <td>{{$row->edad_const}}</td>
            <td>
                
                <!--Editar-->
                <a id="construccion-edit{{$row->gid}}" onclick="editar_construccion('{{$row->gid}}')" class="btn btn-warning editar" title="Editar Construcción">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <!--borrar-->
                <a id="construccion-delete{{$row->gid}}" onclick="eliminar_construccion('{{$row->gid}}')" class="btn btn-danger eliminar" title="Eliminar Construcción">
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
$("#const-nuevo").click(function(){
        $("#panel-construccion").toggle();
        document.getElementById('gid_construccion').value=0;
        $('.mensaje').html('');


    });

$('#formConstruccion').bind('submit',function () 
    {   
        
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario.
            processData: false,
            contentType: false,
            url: '/guardar-construccion',
            beforeSend: function()
            {
                $('.mensaje').html('<div class="alert alert-info">Guardando....</div>');
            },
            success: function (data) 
            {   

                if(data.estado!='success')
                {
                    alert(data[1]);
                    $('.mensaje').html('<div class="alert alert-danger">Error al guardar, verifique sus datos.</div>');  
                }
                else 
                {    
                    var table = document.getElementById("table-construcciones");

                    if (data.gid_construccion>0)
                    {
                        var td = $('#construccion-edit'+data.gid_construccion).parent();
                        var tr = td.parent().index()+1;
                        alert(tr);
                        table.deleteRow(tr);
                    }     
                    
                    //En caso de que exista, la eliminara.

                    //Se crea la tabla de predios dinamicamente

                    var tbody = table.getElementsByTagName('tbody')[0];
                    row = tbody.insertRow();
                    cell = row.insertCell(0);
                    cell.innerHTML=data.nivel;
                    cell = row.insertCell(1);
                    cell.innerHTML=data.sup_const;
                    cell = row.insertCell(2);
                    cell.innerHTML=data.edad_const;
                    cell = row.insertCell(3);
                    var editar = '<a id="construccion-edit{{$row->gid}}" onclick="editar_construccion('+"'"+data.gid_construccion2+"'"+')" class="btn btn-warning editar" title="Editar Construcción">'+
                                        '<span class="glyphicon glyphicon-edit"></span>'+
                                    '</a> ';
                    var eliminar = '<a id="construccion-delete{{$row->gid}}" onclick="eliminar_construccion('+"'"+data.gid_construccion2+"'"+')" class="btn btn-danger eliminar" title="Eliminar Construcción">'+
                                        '<span class="glyphicon glyphicon-remove"></span>'
                                    '</a>';

                   
                    cell.innerHTML=editar+eliminar;
                    $('.mensaje').html('<div class="alert alert-success">Datos guardados correctamente.</div>');

                
               }
            


            }
        });
        return false;
    });

function editar_construccion(gid)
{
    

    var td = $('#construccion-edit'+gid).parent();
    var tr = td.parent().index();
    
    
    
    
    $.ajax(
            {
                type: 'GET',
                data: {gid: gid, tr:tr}, //Toma todo lo que hay en el formulario.
                url: '/cargar-construccion',
                beforeSend: function()
                {
                   $('.mensaje').html('<div class="alert alert-info">Cargando registro....</div>'); 
                },
                success: function (data) 
                {               
                   
                document.getElementById('nivel').value = data.nivel;
                document.getElementById('superficie_construccion').value = data.sup_const;
                document.getElementById('edad_construccion').value = data.edad_const;
                document.getElementById('uso_construccionc').value = data.id_tuc;
                document.getElementById('clase_construccion').value = data.id_tcc;
                document.getElementById('techo_construccion').value = data.id_ttc;
                document.getElementById('estado_conservacion').value = data.id_tec;
                document.getElementById('muro_construccion').value = data.id_tmc;
                document.getElementById('piso_construccion').value = data.id_tpic;
                document.getElementById('puerta_construccion').value = data.id_tpuc;
                document.getElementById('ventana_construccion').value = data.id_tvc;
                $('.mensaje').html('');
                $('#panel-construccion').show();
                document.getElementById('gid_construccion').value = data.gid;
                


                }
            });
}

function eliminar_construccion(gid)
{
    $.ajax(
        {
            type: 'POST',
            data: {gid_construccion: gid}, //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            url: '/eliminar-construccion',
            beforeSend: function()
            {
                $('.mensaje').html('<div class="alert alert-info">Eliminando registro....</div>');
            },
            success: function (data) 
            {
                
                $('.mensaje').html('<div class="alert alert-warning">Se elimino un registro.</div>');
                //Se obtiene el elemento table
                var td = $('#construccion-delete'+data.gid_construccion).parent();
                var tr = td.parent().remove();


            }
        });
}
</script>

@append

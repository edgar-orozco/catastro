
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
                    {{Form::number('nivel',1,['class'=>'form-control', 'required', 'id'=>'nivel', 'min' => '1','readonly' ])}}
                </div>
            </div>
            
<!--            <div class="col-md-3">
                <div class="form-group">
                    Form::label('Lsuperficie_construccion', 'Superficie:')
                    Form::number('superficie_construccion', 1, ['id'=>'superficie_construccion','class'=>'form-control', 'min' => '1','step'=>'0.01'])
                </div>
            </div>-->
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
                    {{Form::label('Lestado_conservacion','Estado de conservación:')}}
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
        
        {{form::button('Agregar', ['class' => 'btn btn-primary',  'type' => 'submit', 'id' => 'agregar-const'])}}
        {{form::button('Cancelar', ['class' => 'btn btn-warning', 'id' => 'cancelar-construccion'])}}

    {{Form::close()}}
</div>

<!--{{form::button('Nuevo', ['class'=>'btn btn-primary', 'id' => 'const-nuevo'])}}-->
<div id="div-table" class="row">
<table class="table" id="table-construcciones">
    <thead>
        <tr>
            <th>Nivel</th>
            <th>Edad</th>
            <th>Clase Construcción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
       
        @foreach($datos_construcciones as $row)
        <tr>

            <td>{{$row->nivel}}</td>
            <td>{{$row->edad_const}}</td>
            <td>{{$row->descripcion}}</td>
            <td>
                
                <!--Editar-->
                <a id="construccion-edit{{$row->gid}}" onclick="editar_construccion('{{$row->gid}}')" class="btn btn-warning editar" title="Editar Construcción">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <!--borrar-->
                <a id="construccion-delete{{$row->gid}}" data-onclickcon="eliminar_construccion('{{$row->gid}}')" data-toggle="modal"  data-target="#construcciones-alert-modal" href="#" class="btn btn-danger construcciones-eliminar" title="Eliminar Construcción">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>

            </td>
        </tr>
        @endforeach
    <tfoot>

    </tfoot>
</table>
</div>






<!-- Modal -->
<div class="modal fade" id="construcciones-alert-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body" id="construcciones-modalBody">

      </div>
      <div class="modal-footer" id="construcciones-modal-footer">
        
      </div>
    </div>
  </div>
</div>


@section('javascript')


<script type="text/javascript">

    //Se activa al momento de eliminar una construccion
    $(".container").on("click", ".construcciones-eliminar", function(){
        //Tomamos su href del boton que se le dio click
        var href = $(this).attr('href');
        //Tomamos el data-onclickon del boton que se le dio click
        var onclick = $(this).attr('data-onclickcon');
        $("#const-nuevo").show();
        $("#panel-construccion").hide();
        $('.mensaje').html('');


        //Editamos Texto del modal
        $('#construcciones-modalBody').html('¿Esta seguro de eliminar esta construcción?');
        $('#construcciones-modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button data-dismiss="modal" type="button" onclick="'+onclick+'" class="btn btn-danger">Eliminar</button>'); 
        
    });



$("#const-nuevo").click(function(){
        $("#panel-construccion").toggle();
        document.getElementById('gid_construccion').value=0;
        $('.mensaje').html('');
        $("#const-nuevo").toggle();
        document.getElementById('nivel').value = '';
        //document.getElementById('superficie_construccion').value = '';
        document.getElementById('edad_construccion').value = '';
        document.getElementById('uso_construccionc').value = '';
        document.getElementById('clase_construccion').value = '';
        document.getElementById('techo_construccion').value = '';
        document.getElementById('estado_conservacion').value = '';
        document.getElementById('muro_construccion').value = '';
        document.getElementById('piso_construccion').value = '';
        document.getElementById('puerta_construccion').value = '';
        document.getElementById('ventana_construccion').value = '';


    });

$("#cancelar-construccion").click(function(){
        $("#panel-construccion").hide();
        $("#panel-construccion").hide();
        $("#const-nuevo").show();
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
                //En caso de que haya algun error del lado del servidor, se manda un mensaje.
                if(data.estado!='success')
                {
                    $('.mensaje').html('<div class="alert alert-danger">Error al guardar, verifique sus datos.</div>');  
                }
                else //Si no hay error, se toma la tabla construcciones y se le asigna a la variable table
                {    
                    var table = document.getElementById("table-construcciones");

                    //Si es verdadero, quiere decir que se esta editando y se procede a eliminar de la tabla los registros editados
                    if (data.gid_construccion>0)
                    {
                        //nos situamos en el td
                        var td = $('#construccion-edit'+data.gid_construccion).parent();
                        //Despues solicitamos el index del tr
                        var tr = td.parent().index()+1;
                        //Procedemos a eliminar el tr
                        table.deleteRow(tr);
                    }     
                    
                    //Se crea la tabla de construcciones dinamicamente
                    //Nos situamos en el tbody de la tabla y la asignamos a la variable tbody
                    var tbody = table.getElementsByTagName('tbody')[0];
                    //Agregamos en la variable row la accion de agregarle una fila al tbody
                    row = tbody.insertRow();
                    //Agregamos en la variable cell la accion de agregarle una celda a la fila en la posicion 0
                    cell = row.insertCell(0);
                    //Agregamos el valor que queremos pintar en la celda creada
                    cell.innerHTML=data.nivel;
                    cell = row.insertCell(1);
                    cell.innerHTML=data.edad_const;
                    cell = row.insertCell(2);
                    cell.innerHTML=data.clase_const;
                    cell = row.insertCell(3);
                    var editar = '<a id="construccion-edit'+data.gid_construccion2+'" onclick="editar_construccion('+"'"+data.gid_construccion2+"'"+')" class="btn btn-warning editar" title="Editar Construcción">'+
                                        '<span class="glyphicon glyphicon-edit"></span>'+
                                    '</a> ';
                    var eliminar = '<a id="construccion-delete'+data.gid_construccion2+'" data-onclickcon="eliminar_construccion('+"'"+data.gid_construccion2+"'"+')" data-toggle="modal"  data-target="#construcciones-alert-modal" href="#" class="btn btn-danger construcciones-eliminar" title="Eliminar Construcción">'+
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
    
    //Nos situamos en el td
    var td = $('#construccion-edit'+gid).parent();
    //Nos movemos al padre del td, en este caso tr y le solicitamos su index
    var tr = td.parent().index();
        
    $.ajax(
            {
                type: 'GET',
                data: {gid: gid, tr:tr}, 
                url: '/cargar-construccion',
                beforeSend: function()
                {
                   $('.mensaje').html('<div class="alert alert-info">Cargando registro....</div>'); 
                },
                success: function (data) 
                {               
                //Se agregan los valores a editar al formulario
                document.getElementById('nivel').value = data.nivel;
//                document.getElementById('superficie_construccion').value = data.sup_const;
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
                $("#const-nuevo").hide();
                document.getElementById('gid_construccion').value = data.gid;
                


                }
            });
}

function eliminar_construccion(gid)
{
    $("#panel-construccion").hide();
    $("#panel-construccion").hide();
    $("#const-nuevo").show();
    $('.mensaje').html('');
    $.ajax(
        {
            type: 'POST',
            data: {gid_construccion: gid},
            url: '/eliminar-construccion',
            beforeSend: function()
            {
                $('.mensaje').html('<div class="alert alert-info">Eliminando registro....</div>');
            },
            success: function (data) 
            {
                //Se agrega el mensaje de que se elimino el registro
                $('.mensaje').html('<div class="alert alert-warning">Se elimino un registro.</div>');
                //nos situamos en el td que se va a eliminar 
                var td = $('#construccion-delete'+data.gid_construccion).parent();
                //Decimos que elimine al parent del td en el que estamos, en este caso seria el tr
                var tr = td.parent().remove();


            }
        });
}
</script>

@append

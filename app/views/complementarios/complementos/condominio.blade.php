  <?php
        $url = URL::current();
        $new = explode("/", $url);
        $count = count($new);
        $count = $count - 1;
        $clave = $new[$count];
        ?>
        <div class="mensaje"></div>
{{ Form::open (array('url'=>'/agregar-condominio', 'name'=>'fguardar', 'id'=>'fguardar'))}}
    <table class="table">
    <thead>
        <tr>
            <th>{{Form::label('no_condominal','Número condominal:') }}</th>
            <th>{{Form::label('sup_comun','Superficie Comun:') }}</th>
            <th>{{Form::label('indiviso','Porcentaje indiviso:') }}</th>
            <th>{{Form::label('sup_total_comun','Superfie Total Común:') }}</th>
            <th>{{Form::label('tipo_priva','Superficie Privativa:') }}</th>
            
        </tr>
    </thead>
     <tbody>
<tr>
    <td>
    {{ Form::hidden('id',$clave) }}
    {{ Form::hidden('id_condominio','',array('id' => 'id_condominio')) }}
       {{ Form::text('no_condominal', null, array('class' => 'form-control focus  ', 'placeholder'=>'No Condominal', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}

    </td><td>
    <span style=" margin-left: 161px;"><strong>M<sup>2</sup></strong></span>
    {{ Form::text('sup_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun', 'autofocus'=> 'autofocus','style'=>'width: 158px;margin-top: -24px;')) }}
    </td><td>
    {{ Form::text('indiviso', null, array('class' => 'form-control focus  ', 'placeholder'=>'Porcentaje Indiviso', 'autofocus'=> 'autofocus','style'=>'width: 150px;margin-top: -4px;')) }}
    {{$errors->first("indiviso")}}
    </td><td>
    <span style=" margin-left: 154px;"><strong>M<sup>2</sup></strong></span>
    {{ Form::text('sup_total_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Total', 'autofocus'=> 'autofocus','style'=>'width: 150px;margin-top: -24px;')) }}
    </td><td>
         <span style=" margin-left: 154px;"><strong>M<sup>2</sup></strong></span>
    {{ Form::text('tipo_priva', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Priva', 'autofocus'=> 'autofocus','style'=>'width: 150px;margin-top: -24px;')) }}

   </td>
</tr>
</tbody>
</table>

{{ Form::submit('Guardar', array('class' => 'btn btn-primary guardar', 'id'=>'guardar')) }}
{{ Form::reset('Limpiar formato',  ['class' => 'btn btn-warning', 'onclick'=>'limpiar()']) }}   
{{ Form::close() }}

<table class="table" id="table-condominios">
    <thead>
        <tr>
            <th>Numero Condominal</th>
            <th>Superficie Privativa</th>
            <th>Superficie Comun</th>
            <th>Indiviso</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>


        @foreach($condominio as $row)
        <tr>
            <td>{{$row->no_condominal }}</td>
            <td>{{$row->tipo_priva }}</td>
            <td>{{$row->sup_comun }}</td>
            <td>{{$row->indiviso }}</td>
            <td nowrap>
                <a onclick="update('{{$row->id_condominio}}')" data-toggle="modal" data-target="#condominio-editar"   class="btn btn-warning nuevo" title="Editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>

                <!--borrar-->
                <a id="anchor-delete{{$row->id_condominio}}" onclick="eliminar('{{$row->id_condominio}}')"  class="btn btn-danger nuevo" title="Borrar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>






@section('javascript')


<script type="text/javascript">


$('#fguardar').bind('submit',function ()
    {//AJAX GUARDA DATOS
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/agregar-condominio',
            //AVISO MIENTAS GUARDA
            beforeSend: function()
            {
               $('.mensaje').html('Guardando Registro... <span class="glyphicon glyphicon-refresh spin"></span>');
            },

            success: function (data)
            {

                if(data.valor==1)
                {
                    $('.mensaje').html('<div class="alert alert-success">El registro se actualizo correctamente.</div>');
                    //elimina registro actual
                var td = $('#anchor-delete'+data.id_condominio).parent();
                var tr = td.parent().remove();
               //crea el nuevo registro actualizado
                var table = document.getElementById("table-condominios");
                var tbody = table.getElementsByTagName('tbody')[0];
                row = tbody.insertRow();
                cell = row.insertCell(0);
                cell.innerHTML=data.no_condominal;
                 cell = row.insertCell(1);
                cell.innerHTML=data.tipo_priva;
                cell = row.insertCell(2);
                cell.innerHTML=data.sup_comun;
                cell = row.insertCell(3);
                cell.innerHTML=data.indiviso;
                cell = row.insertCell(4);
                //var id_ie = '<input type="text" name="hide_idie" id = "hide_idie" value="'+data.id_condominio+'" hidden>';
                //cell.innerHTML='<a id="anchor-delete'+data.id_condominio+'" onclick="eliminar('+data.id_condominio+')" data-eliminar-type="'+data.id_condominio+'" class="btn btn-warning eliminar" title="Editar Predio"> <span class="glyphicon glyphicon-remove"></span></a>';
                cell.innerHTML='<a onclick="update('+data.id_condominio+')" data-toggle="modal" data-target="#condominio-editar"  class="btn btn-warning nuevo" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>  <a id="anchor-delete'+data.id_condominio+'" onclick="eliminar('+data.id_condominio+')" data-eliminar-type="'+data.id_condominio+'" class="btn btn-danger nuevo" title="Borrar"><span class="glyphicon glyphicon-trash"></span></a>';
                    $('.mensaje').html('');

                }else{
                  //Se obtiene el elemento table
                var table = document.getElementById("table-condominios");
                //En caso de que exista, la eliminara.

                //Se crea la tabla de predios dinamicamente

                var tbody = table.getElementsByTagName('tbody')[0];
                row = tbody.insertRow();
                cell = row.insertCell(0);
                cell.innerHTML=data.no_condominal;
                 cell = row.insertCell(1);
                cell.innerHTML=data.tipo_priva;
                cell = row.insertCell(2);
                cell.innerHTML=data.sup_comun;
                cell = row.insertCell(3);
                cell.innerHTML=data.indiviso;
                cell = row.insertCell(4);
                //var id_ie = '<input type="text" name="hide_idie" id = "hide_idie" value="'+data.id_condominio+'" hidden>';
                //cell.innerHTML='<a id="anchor-delete'+data.id_condominio+'" onclick="eliminar('+data.id_condominio+')" data-eliminar-type="'+data.id_condominio+'" class="btn btn-warning eliminar" title="Editar Predio"> <span class="glyphicon glyphicon-remove"></span></a>';
                cell.innerHTML='<a onclick="update('+data.id_condominio+')" data-toggle="modal" data-target="#condominio-editar"  class="btn btn-warning nuevo" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>  <a id="anchor-delete'+data.id_condominio+'" onclick="eliminar('+data.id_condominio+')" data-eliminar-type="'+data.id_condominio+'" class="btn btn-danger nuevo" title="Borrar"><span class="glyphicon glyphicon-trash"></span></a>';
                    $('.mensaje').html('');
                    }
            }
        });
        return false;
    });


function eliminar(id_condominio)
{

   $.ajax(
        {
            type: 'POST',
            data: {id_condominio:id_condominio}, //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            url: '/cargar-condominio-destroy',
            beforeSend: function()
            {
                $('.mensaje').html('Eliminando Registro... <span class="glyphicon glyphicon-refresh spin"></span>');
            },
            success: function (data)
            {
                $('.mensaje').html('<div class="alert alert-danger">El registro se aelimino correctamente.</div>');
                 //Se obtiene el elemento table
                var td = $('#anchor-delete'+data.id_condominio).parent();
                var tr = td.parent().remove();
                $('.mensaje').html('');


            }
        });
}

function update(id_condominio)
{

 //$("#target").show();
    $.ajax(
        {
            type: 'POST',
            data: {id_condominio:id_condominio}, //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            url: '/cargar-condominio',
            beforeSend: function()
            {
                $('.mensaje').html('Actualizando Registro... <span class="glyphicon glyphicon-refresh spin"></span>');
            },
            success: function (data) 
            {
                document.getElementById('id_condominio').value =data.id_condominio;
                //document.getElementById('entidad').value =data.entidad;
                //document.getElementById('municipios').value =data.municipio;
                document.getElementById('tipo_priva').value =data.tipo_priva;
                document.getElementById('sup_comun').value =data.sup_comun;
                document.getElementById('indiviso').value =data.indiviso;
                document.getElementById('sup_total_comun').value =data.sup_total_comun;
                document.getElementById('no_condominal').value =data.no_condominal;
                $('.mensaje').html('');
            }
        });
}
function limpiar()
{
    
    document.getElementById('id_condominio').value ='';
}
</script>
@append
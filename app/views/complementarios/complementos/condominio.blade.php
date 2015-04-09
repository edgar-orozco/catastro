  <?php
        $url = URL::current();
        $new = explode("/", $url);
        $count = count($new);
        $count = $count - 1;
        $clave = $new[$count];
        ?>
{{ Form::open (array('url'=>'/agregar-condominio', 'name'=>'fguardar', 'id'=>'fguardar'))}}
    <table class="table">
    <thead>
        <tr>
            <th>{{Form::label('entidad','Entidad:') }}Superficie Privativa:</th>
            <th>Superficie Comun:</th>
            <th>Indiviso:</th>
            <th>Superfie Total Común:</th>
            <th>No Unidades:</th>
        </tr>
    </thead>
     <tbody>
<tr>
    <td>
    {{ Form::hidden('id',$clave) }}
    {{ Form::text('tipo_priva', null, array('class' => 'form-control focus  ', 'placeholder'=>'Tipo Priva', 'autofocus'=> 'autofocus')) }}
    </td><td>
    {{ Form::text('sup_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun', 'autofocus'=> 'autofocus')) }}
    </td><td>
    {{ Form::text('indiviso', null, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso', 'autofocus'=> 'autofocus')) }}
    {{$errors->first("indiviso")}}
    </td><td>
    {{ Form::text('sup_total_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Total', 'autofocus'=> 'autofocus')) }}
    </td><td>
   {{ Form::text('no_unidades', null, array('class' => 'form-control focus  ', 'placeholder'=>'No Unidades', 'autofocus'=> 'autofocus')) }}
    </td>
</tr>
</tbody>
</table>

{{ Form::submit('Guardar', array('class' => 'btn btn-primary guardar', 'id'=>'guardar')) }}
{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}   
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

<div id="target" style="display: none;">
{{ Form::open ( array('url'=>'/cargar-condominio-editar',))}}
<table class="table" id="table-condominios">
     <thead>
        <tr>
           
            <th>{{Form::label('entidad','Entidad:') }}</th>
            <th>{{Form::label('municipios','Municipio:') }}</th>
            <th>{{Form::label('tipo_priva','Tipo Priva:') }}</th>
            <th>{{Form::label('sup_comun','Superficie Comun:') }} </th>
            <th>{{Form::label('indiviso','Indiviso:') }}</th>
            <th>{{Form::label('sup_total_comun','Superfie Total Común:') }}</th>
            <th>{{Form::label('no_unidades','No Unidades:') }}</th>
        </tr>
    </thead>
     <tbody>
        <tr>
            <td>
                {{ Form::hidden('id',$clave,array('id'=>'id_condominio')) }}
                {{ Form::text('entidad',$condominios->entidad, array('class' => 'form-control focus  ', 'placeholder'=>'Entidad', 'autofocus'=> 'autofocus')) }}
            </td><td>
                {{ Form::text('municipios',$condominios->municipio, array('class' => 'form-control focus  ', 'placeholder'=>'Municipio', 'autofocus'=> 'autofocus')) }}
            </td><td>
                {{ Form::text('tipo_priva',$condominios->tipo_priva, array('class' => 'form-control focus  ', 'placeholder'=>'Tipo Priva', 'autofocus'=> 'autofocus')) }}
            </td><td>
                {{ Form::text('sup_comun',$condominios->sup_comun, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun', 'autofocus'=> 'autofocus')) }}
            </td><td>
                {{ Form::text('indiviso',$condominios->indiviso, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso', 'autofocus'=> 'autofocus')) }}
                {{$errors->first("indiviso")}}
            </td><td>
                {{ Form::text('sup_total_comun',$condominios->sup_total_comun, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Total', 'autofocus'=> 'autofocus')) }}
            </td><td>
                {{ Form::text('no_unidades',$condominios->no_unidades, array('class' => 'form-control focus  ', 'placeholder'=>'No Unidades', 'autofocus'=> 'autofocus')) }}
            </td>
   </tr>
    </tbody>
</table>
{{ Form::submit('Guardar', array('class' => 'btn btn-primary  ')) }}
{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning  ']) }}   
{{ Form::close() }}
</div>




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
                alert('Enviando datos');
            },

            success: function (data)
            {
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
                cell.innerHTML='<a data-toggle="modal" data-target="#condominio-editar"  class="btn btn-warning nuevo" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>  <a id="anchor-delete'+data.id_condominio+'" onclick="eliminar('+data.id_condominio+')" data-eliminar-type="'+data.id_condominio+'" class="btn btn-danger nuevo" title="Borrar"><span class="glyphicon glyphicon-trash"></span></a>';

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
                //alert("mandando petición");
            },
            success: function (data) 
            {
                alert("guardado correcto");
                 //Se obtiene el elemento table
                var td = $('#anchor-delete'+data.id_condominio).parent();
                var tr = td.parent().remove();


            }
        });
}

function update(id_condominio)
{
alert(id_condominio);
 $("#target").show();
    $.ajax(
        {
            type: 'POST',
            data: {id_condominio:id_condominio}, //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            url: '/cargar-condominio',
            beforeSend: function()
            {
                //alert("mandando petición");
            },
            success: function (data) 
            {
                document.getElementById('id_condominio').value =data.id_condominio;
                document.getElementById('entidad').value =data.entidad;
                document.getElementById('municipios').value =data.municipio;
                document.getElementById('tipo_priva').value =data.tipo_priva;
                document.getElementById('sup_comun').value =data.sup_comun;
                document.getElementById('indiviso').value =data.indiviso;
                document.getElementById('sup_total_comun').value =data.sup_total_comun;
                document.getElementById('no_unidades').value =data.no_unidades;
            }
        });
}
</script>
@append
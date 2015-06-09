<style>
    .clickable
    {
        cursor: pointer;
    }

    .clickable .glyphicon
    {
        background: rgba(0, 0, 0, 0.15);
        display: inline-block;
        padding: 6px 12px;
        border-radius: 4px
    }

    .panel-heading span
    {
        margin-top: -23px;
        font-size: 15px;
        margin-right: -9px;
    }
    a.clickable { color: inherit; }
    a.clickable:hover { text-decoration:none; }
</style>
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
            <th>{{Form::label('tipo_priva','Privativa:') }}</th>
            <th>{{Form::label('indiviso','Indiviso:') }}</th>
            <th>{{Form::label('sup_terr_privativa','Sup Terreno Privativa:') }}</th>
            <th>{{Form::label('sup_const_privativa','Superficie Total Terreno:') }}</th>
            <th>{{Form::label('sup_total_construccion','Superficie Total Construccion:') }}</th>
            <th>{{Form::label('sup_total_terreno','Superficie Magno Construccion:')}}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{ Form::hidden('id',$clave) }}
                {{ Form::hidden('id_condominio','',array('id' => 'id_condominio')) }}
                {{ Form::text('no_condominal', null, array('class' => 'form-control focus  ', 'placeholder'=>'No Condominal', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
            </td>
            <td>
                {{ Form::text('tipo_priva', null, array('class' => 'form-control focus  ', 'placeholder'=>'Tipo Privativa', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
            </td>
            <td>
                {{ Form::text('indiviso', null, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
            </td>
            <td>
                {{ Form::text('sup_terr_privativa', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Construccion', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
            </td>
            <td>
                {{Form::text('sup_const_privativa',null,array('class' => 'form-control focus  ', 'placeholder'=>'sup_const_privativa', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;'))}}
            </td>
            <td>
                {{ Form::text('sup_total_construccion', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superfice Construccion', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
            </td>
            <td>
                {{ Form::text('sup_total_terreno', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Terreno', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
            </td>
        </tr>
    </tbody>
</table>
<!--<div class="container">-->
<div class="row" style="width: 2300px;"style="width: 2300px;">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading clickable">
                <h3 class="panel-title">
                    Condominio Magno</h3>
                <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{Form::label('no_cond_magno','No Condominio Magno') }}</th>
                            <th>{{Form::label('sup_cond_magno_terreno','Superficie Magno Terreno') }}</th>
                            <th>{{Form::label('sup_cond_magno_construccion','Superficie Magno Construcción') }}</th>
                            <th>{{Form::label('sup_comun_magno_terreno','Superficie Común Magno Terreno') }}</th>
                            <th>{{Form::label('sup_comun_magno_construccion','Superficie Común Magno Construcción') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ Form::text('no_cond_magno', 0, array('class' => 'form-control focus  ', 'placeholder'=>'No Condominio Magno', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
                            </td>
                            <td>
                                {{ Form::text('sup_cond_magno_terreno',0, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Magno Terreno', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
                            </td>
                            <td>
                                {{ Form::text('sup_cond_magno_construccion',0, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Magno Construcción', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
                            </td>
                            <td>
                                {{ Form::text('sup_comun_magno_terreno',0, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Magno Terreno', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
                            </td>
                            <td>
                                {{ Form::text('sup_comun_magno_construccion', 0, array('class' => 'form-control focus  ', 'placeholder'=>'Sup. Común Magno Construccion', 'autofocus'=> 'autofocus','style'=>'width: 120px;margin-top: -4px;')) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
{{ Form::submit('Guardar', array('class' => 'btn btn-primary guardar', 'id'=>'guardar')) }}
{{ Form::reset('Limpiar formato',  ['class' => 'btn btn-warning', 'onclick'=>'limpiar()']) }}
{{ Form::close() }}
<table class="table" id="table-condominios">
    <thead>
        <tr>
<!--            <th>Numero Condominal</th>
            <th>Superficie Privativa</th>
            <th>Superficie Comun</th>
            <th>Indiviso</th>-->
            <th>{{Form::label('no_condominal','Número Condominal:') }}</th>
            <th>{{Form::label('tipo_priva','Privativa:') }}</th>
            <th>{{Form::label('indiviso','Indiviso:') }}</th>
            <th>{{Form::label('sup_terr_privativa','Sup. Terreno Privativa:') }}</th>
            <th>{{Form::label('sup_const_privativa','Sup. Total Terreno:') }}</th>
            <th>{{Form::label('sup_total_construccion','Sup. Total Construccion:') }}</th>
            <th>{{Form::label('sup_total_terreno','Sup. Magno Construcción:')}}</th>
            <th>{{Form::label('no_cond_magno','No. Condominio Magno') }}</th>
            <th>{{Form::label('sup_cond_magno_terreno','Sup. Magno Terreno') }}</th>
            <th>{{Form::label('sup_cond_magno_construccion','Sup. Magno Construcción') }}</th>
            <th>{{Form::label('sup_comun_magno_terreno','Sup. Común Magno Terreno') }}</th>
            <th>{{Form::label('sup_comun_magno_construccion','Sup. Común Magno Construcción') }}</th>

            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>


        @foreach($condominio as $row)
        <tr>
            <td>{{$row->no_condominal }}</td>
            <td>{{$row->tipo_priva }}</td>           
            <td>{{$row->indiviso }}</td>
            <td>{{$row->sup_terr_privativa }}</td>
            <td>{{$row->sup_const_privativa }}</td>
            <td>{{$row->sup_total_construccion }}</td> 
            <td>{{$row->sup_total_terreno }}</td>
            <td>{{$row->no_cond_magno}}</td>
            <td>{{$row->sup_cond_magno_terreno }}</td>
            <td>{{$row->sup_cond_magno_construccion }}</td>
            <td>{{$row->sup_comun_magno_terreno }}</td>
            <td>{{$row->sup_comun_magno_construccion }}</td>

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


                    $('#fguardar').bind('submit', function ()
            {//AJAX GUARDA DATOS
            $.ajax(
            {
            type: 'POST',
                    data: new FormData(this), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
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

                    if (data.valor == 1)
                    {
                    $('.mensaje').html('<div class="alert alert-success">El registro se actualizo correctamente.</div>');
                            //elimina registro actual
                            var td = $('#anchor-delete' + data.id_condominio).parent();
                            var tr = td.parent().remove();
                            //crea el nuevo registro actualizado
                            var table = document.getElementById("table-condominios");
                            var tbody = table.getElementsByTagName('tbody')[0];
                            row = tbody.insertRow();
                            cell = row.insertCell(0);
                            cell.innerHTML = data.no_condominal;
                            cell = row.insertCell(1);
                            cell.innerHTML = data.tipo_priva;
                            cell = row.insertCell(2);
                            cell.innerHTML = data.indiviso;
                            cell = row.insertCell(3);
                            cell.innerHTML = data.sup_terr_privativa;
                            cell = row.insertCell(4);
                            cell.innerHTML = data.sup_const_privativa;
                            cell = row.insertCell(5);
                            cell.innerHTML = data.sup_const_privativa;
                            cell = row.insertCell(6);
                            cell.innerHTML = data.sup_total_terreno;
                            cell = row.insertCell(7)
                            cell.innerHTML = data.no_cond_magno;
                            cell = row.insertCell(8)
                            cell.innerHTML = data.sup_cond_magno_terreno;
                            cell = row.insertCell(9)
                            cell.innerHTML = data.sup_cond_magno_construccion;
                            cell = row.insertCell(10)
                            cell.innerHTML = data.sup_comun_magno_terreno;
                            cell = row.insertCell(11)
                            cell.innerHTML = data.sup_comun_magno_construccion;
                            cell = row.insertCell(12)

//
                            //var id_ie = '<input type="text" name="hide_idie" id = "hide_idie" value="'+data.id_condominio+'" hidden>';
                            //cell.innerHTML='<a id="anchor-delete'+data.id_condominio+'" onclick="eliminar('+data.id_condominio+')" data-eliminar-type="'+data.id_condominio+'" class="btn btn-warning eliminar" title="Editar Predio"> <span class="glyphicon glyphicon-remove"></span></a>';
                            cell.innerHTML = '<a onclick="update(' + data.id_condominio + ')" data-toggle="modal" data-target="#condominio-editar"  class="btn btn-warning nuevo" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>  <a id="anchor-delete' + data.id_condominio + '" onclick="eliminar(' + data.id_condominio + ')" data-eliminar-type="' + data.id_condominio + '" class="btn btn-danger nuevo" title="Borrar"><span class="glyphicon glyphicon-trash"></span></a>';
                            $('.mensaje').html('');
                    } else{
                    //Se obtiene el elemento table
                    var table = document.getElementById("table-condominios");
                            //En caso de que exista, la eliminara.

                            //Se crea la tabla de predios dinamicamente

                            var tbody = table.getElementsByTagName('tbody')[0];
                            row = tbody.insertRow();
                            cell = row.insertCell(0);
                            cell.innerHTML = data.no_condominal;
                            cell = row.insertCell(1);
                            cell.innerHTML = data.tipo_priva;
                            cell = row.insertCell(2);
                            cell.innerHTML = data.indiviso;
                            cell = row.insertCell(3);
                            cell.innerHTML = data.sup_terr_privativa
                            cell = row.insertCell(4);
                            cell.innerHTML = data.sup_const_privativa;
                            cell = row.insertCell(5);
                            cell.innerHTML = data.sup_total_construccion;
                            cell = row.insertCell(6);
                            cell.innerHTML = data.sup_total_terreno;
                            cell = row.insertCell(7)
                            //
                            cell.innerHTML = data.no_cond_magno;
                            cell = row.insertCell(8)
                            cell.innerHTML = data.sup_cond_magno_terreno;
                            cell = row.insertCell(9)
                            cell.innerHTML = data.sup_cond_magno_construccion;
                            cell = row.insertCell(10)
                            cell.innerHTML = data.sup_comun_magno_terreno;
                            cell = row.insertCell(11)
                            cell.innerHTML = data.sup_comun_magno_construccion;
                            cell = row.insertCell(12)

//                            cell.innerHTML = data.indiviso;
//                            cell = row.insertCell(9);
                            //var id_ie = '<input type="text" name="hide_idie" id = "hide_idie" value="'+data.id_condominio+'" hidden>';
                            //cell.innerHTML='<a id="anchor-delete'+data.id_condominio+'" onclick="eliminar('+data.id_condominio+')" data-eliminar-type="'+data.id_condominio+'" class="btn btn-warning eliminar" title="Editar Predio"> <span class="glyphicon glyphicon-remove"></span></a>';
                            cell.innerHTML = '<a onclick="update(' + data.id_condominio + ')" data-toggle="modal" data-target="#condominio-editar"  class="btn btn-warning nuevo" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>  <a id="anchor-delete' + data.id_condominio + '" onclick="eliminar(' + data.id_condominio + ')" data-eliminar-type="' + data.id_condominio + '" class="btn btn-danger nuevo" title="Borrar"><span class="glyphicon glyphicon-trash"></span></a>';
                            $('.mensaje').html('');
                    }
                    },
                    error: function() {
                    $('.mensaje').html('<div class="alert alert-danger">Error al guardar</div>');
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
                                    var td = $('#anchor-delete' + data.id_condominio).parent();
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
                    document.getElementById('id_condominio').value = data.id_condominio;
                            //document.getElementById('entidad').value =data.entidad;
                            //document.getElementById('municipios').value =data.municipio;
                            document.getElementById('no_condominal').value = data.no_condominal;
                            document.getElementById('tipo_priva').value = data.tipo_priva;
                            document.getElementById('indiviso').value = data.indiviso;
                            document.getElementById('sup_terr_privativa').value = data.sup_terr_privativa;
                            document.getElementById('sup_const_privativa').value = data.sup_const_privativa;
                            document.getElementById('sup_total_construccion').value = data.sup_total_construccion;
                            document.getElementById('sup_total_terreno').value = data.sup_total_terreno;
                            //
                            document.getElementById('no_cond_magno').value = data.no_cond_magno;
                            document.getElementById('sup_cond_magno_terreno').value = data.sup_cond_magno_terreno;
                            document.getElementById('sup_cond_magno_construccion').value = data.sup_cond_magno_construccion;
                            document.getElementById('sup_comun_magno_terreno').value = data.sup_comun_magno_terreno;
                            document.getElementById('sup_comun_magno_construccion').value = data.sup_comun_magno_construccion;
                            $('.mensaje').html('');
                    }
            });
            }
            function limpiar()
            {

            document.getElementById('id_condominio').value = '';
            }
            $(document).on('click', '.panel-heading span.clickable', function (e) {
            var $this = $(this);
                    if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
            $this.parents('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
            });
                    $(document).on('click', '.panel div.clickable', function (e) {
            var $this = $(this);
                    if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
            $this.parents('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
            });
                    $(document).ready(function () {
            $('.panel-heading span.clickable').click();
                    $('.panel div.clickable').click();
            });
</script>

@append
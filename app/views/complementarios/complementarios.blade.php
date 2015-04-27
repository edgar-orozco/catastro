@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
{{ HTML::style('css/forms.css') }}
<h1>Captura de Datos Complementarios </h1>
@if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

@endif
<div class="panel-body">
    {{ Form::open(array('id' => 'formComplemen', 'class' => 'formComplemen', 'role' => 'form', 'method' => 'GET' )) }}
    <div class="row">

        <div class="col-md-3">

            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search"></span>
                </span>

                {{Form::select('municipio', $municipios, null, ['id'=>'municipio','class'=>'form-control'])}}
                </br>
            </div><!-- /input-group -->
        </div>
        <div class="col-md-3">

            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search"></span>
                </span>

                {{ Form::text('b',null, array('class' => 'form-control focus', 'id' => 'busqueda', 'placeholder'=>'Clave...', 'autofocus'=> 'autofocus','ng-model' => 'b', 'required' , 'pattern'=> '\d{3}[\-]\d{4}[\-]\d{6}')) }}

                </br>
            </div><!-- /input-group -->
        </div>
    </div>

    {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
        <div class="mensaje">

        </div>

    <div class="list-group" id="div-table">


    </div>
</div>


@stop

@section('javascript')

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    $(document).ready(function()
    {
        var form = $('.formComplemen');
    form.bind('submit',function ()
    {
        $.ajax(
        {
            type: 'GET',
            data:
                {
                    data:document.getElementById('busqueda').value,
                    municipio:document.getElementById('municipio').value
                }, //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            url: '/compleme',
            beforeSend: function()
            {
                $('.mensaje').html('Buscando predio... <span class="glyphicon glyphicon-refresh spin"></span>');
            },
            success: function (data)
            {
                //Se obtiene el elemento table
                var tables = document.getElementById("table");
                //En caso de que exista, la eliminara.
                if (tables) tables.parentNode.removeChild(tables);
                //comprueba si trae predios
                if(data.size>1)
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
                    cell.innerHTML = "<b>Predio</b>";
                    cell =row.insertCell(1);
                    cell.innerHTML = "<b>Clave<b>";
                    cell =row.insertCell(2);
                    cell.innerHTML = "<b>Acciones<b>";
                    var tbody = table.appendChild(document.createElement('tbody'));
                    //Se crea la tabla de predios dinamicamente
                    for (i = 0; i < data.size; i++)
                    {

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
                else if(data.size>0)
                {
                    window.location = "/cargar-complementos/"+data.busqueda[0].gid;
                }
                else
                   {
                        $('.mensaje').html('<div class="alert alert-danger">No se encontro ningun predio. Verifique Clave y Municipio.</div>');
                   }



            }
        });
            return false;
    });

    });


</script>
@stop

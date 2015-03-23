@extends('layouts.default')



{{ HTML::style('js/jquery/jquery-ui.css') }}


@section('styles')

body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

tr.example td.placeholder {
  position: relative;
  /** More li styles **/
}
tr.example td.placeholder:before {
  position: absolute;
  /** Define arrowhead **/
}

@stop

@section('title')
{{{ $title}}} :: @parent
@stop

@section('angular')
ng-app="statuss" ng-controller="StatusCtrl"
@stop

@section('content')
<div class="row">
    <button type="button" class="btn btn-info" ng-click="openForm()" ng-hide="showForm">
        <i class="glyphicon glyphicon-plus"></i> Crear Status
    </button>
    <button type="button" class="btn btn-primary pull-right" ng-click="closeForm()" ng-show="showForm">
        <i class="glyphicon glyphicon-arrow-left"></i> Regresar
    </button>
</div>


<div class="row">
    <div ng-class="showForm ? 'col-sm-4 col-md-4 col-lg-4 resize' : ''" ng-show="showForm">

        {{ Form::open(array('url' => 'catalogos/status', 'method' => 'POST', 'name' => 'formStatus')) }}

        @include('catalogos.status._form')

        <div class="form-actions form-group">
            <button disabled="disabled" class="btn btn-primary" ng-disabled="formStatus.$invalid || isInvalid()" type="button" ng-click="store()">
                {[{ status.id_status!== undefinied ? 'Editar status' : 'Crear nuevo status' }]}
            </button>
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}

           

        </div>
        {{Form::close()}}

    </div>
    <div ng-class="showForm ? 'col-sm-8 col-md-8 col-lg-8' : 'col - sm - 12 col - md - 12 col - lg - 12 resize'">
        {{ Form::open(array('method' => 'POST', 'name' => 'orderStatus', 'id' => 'orderStatus')) }}

            @include('catalogos.status._list', compact('statuss'))

             <button id ="boton" type="submit" class="btn btn-info">
                        <i class="glyphicon glyphicon-plus"> </i>
                        Guardar Orden
                    </button>

        {{Form::close()}}


    </div>
</div>










@stop

@section('javascript')

{{ HTML::script('js/catalogos/status.js') }}
{{ HTML::script('js/laroute.js') }}
{{ HTML::script('js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.js') }}

<script>
//Calendario
$(function() {
    $( ".date-picker" ).datepicker();
  });
//Cambiar a español el calendario
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});






$("#table tbody").sortable(
{
   update: function(event, ui)
   {
        $('#table tr').each(function(index, element)
        {
            var Referencia = $(element).find("td").eq(0).html(index)

        });
    }
});




$('#orderStatus').bind('submit',function () 
        {   
            
            var orden = new Array();
            var id = new Array();
            var id_replace ='';
            var orden_replace ='';
            $('#table tr').each(function(index, element)
            {
                orden_replace   =   $(element).find("td").eq(0).html();
                id_replace      =   $(element).find("td").eq(1).html();
                if(id_replace!=null)
                {
                    orden[index]    =   orden_replace.replace(/(\r\n|\n|\r)/gm,"").trim();
                    id[index]       =   id_replace.replace(/(\r\n|\n|\r)/gm,"").trim();
                }
            });

            
            
            $.ajax(
            {
                type: 'POST',
                data: {orden:orden, id:id}, //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
                url: '/catalogos/status/orden',
                success: function (data) 
                {               
                    alert("Se a guardado el orden correctamente");
                }
            });
            return false;
        });








</script>


@append


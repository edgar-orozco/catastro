<?php
    error_reporting (E_ERROR | E_WARNING);
    setlocale(LC_MONETARY, 'es_MX');
?>
@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop

@section('content')
<div>
    <div class="panel-default">

    <div class="panel-heading">

        <h3 class="panel-title">Busqueda de Predios</h3>

    </div>

</div>
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/theme.default.css') }}
    {{ HTML::style('js/jquery/jquery-ui.css') }}

    @section('javascript')
    {{ HTML::script('js/jquery/jquery-ui.js') }}

<script type="text/javascript">
$(document).ready(function() {
    var t = $('#example').DataTable();
    var counter = 1;

    $('#addRow').on( 'click', function () {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw();

        counter++;
    } );

    // Automatically add a first row of data
    $('#addRow').click();
} );
</script>

@stop

<div class="panel-body">
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <th>Column 3</th>
                <th>Column 4</th>
                <th>Column 5</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <th>Column 3</th>
                <th>Column 4</th>
                <th>Column 5</th>
            </tr>
        </tfoot>
    </table>
</div>

</div>

<div>

@stop

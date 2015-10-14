
@extends('layouts.hooktramite')
<style>
    table.resumen-valor td.sumable {
        text-align: right;
    }
    table.resumen-valor td.listable {
        text-align: left;
    }
    table.resumen-valor tr.totalizable{

    }
</style>

@section('content')
<table class="table resumen-valor">
    <thead>
    <tr>
        <th>VALORES</th>
        <th>TERRENO</th>
        <th>CONSTRUCCIÓN</th>
    </tr>
    </thead>
    <tr>
        <td class="listable">Valor</td>
        <td class="sumable valor-terreno">{{$valor_terreno}}</td>
        <td class="sumable valor-construccion">{{$valor_construccion}}</td>
    </tr>
    <tr>
        <td class="listable">Menos Demérito</td>
        <td class="sumable dem-terreno text-danger">{{$demeritos_terreno}}</td>
        <td class="sumable dem-construccion text-danger">{{$demeritos_construccion}}</td>
    </tr>
    <tr>
        <td class="listable">Más Incrementos</td>
        <td class="sumable inc-terreno text-success">{{$incrementos_terreno}}</td>
        <td class="sumable inc-construccion text-success">0.00</td>
    </tr>
    <tr>
        <td class="listable">V. Ajustado</td>
        <td class="sumable vajust-terreno">{{$ajustado_terreno}}</td>
        <td class="sumable vajust-construccion">{{$ajustado_construccion}}</td>
    </tr>
    <tfoot>
    <tr class="totalizable active">
        <td class="listable">CATASTRAL</td>
        <td colspan="2" class="valor-catastral text-primary">{{$valor_catastral}}</td>

    </tr>
    </tfoot>
</table>
@stop
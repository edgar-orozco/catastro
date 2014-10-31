<h1>Salario Mínimo Vigente por municipio</h1>
@if( count($lista) > 0)
<table class="lista">
    <thead>
        <tr>
            <td>Año</td>
            <td>Area</td>
            <td>Monto</td>
            <td>Modificar</td>
        </tr>
    </thead>
    <tbody>
        @foreach($lista as $valor)
        <tr>
            <td>{{$valor->anio}}</td>
            <td>{{$valor->area}}</td>
            <td> $ {{number_format($valor->monto, 2)}}</td>
            <td>{{ link_to("/admin/smv/{$valor->id}/edit", "Modificar") }} </td>
        </tr>
        @endforeach
     </tbody>
     <tfoot>
        <tr>
            <td></td>
        </tr>
     </tfoot>
</table>
@else
<h2>Sin valores que mostrar</h2>
@endif

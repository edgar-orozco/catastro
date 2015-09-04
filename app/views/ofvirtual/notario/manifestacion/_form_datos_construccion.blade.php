<style>
    table tr td select, table tr td input {
        width: 60px;
        border: none;
    }
</style>

<div class="datos-construccion">
    <table id="datos-construccion">
        <thead>
        <tr>
            <th rowspan="2">Bloque</th>
            <th rowspan="2">Superficie de construcción</th>
            <th rowspan="2">Tipo de construcción</th>
            <th colspan="8">Características de la construcción</th>
            <th rowspan="2">Inst. Espec.</th>
            <th rowspan="2">Antig. (años)</th>
            <th rowspan="2">Edo. Const.</th>
            <th rowspan="2">Avance (%)</th>
            <th rowspan="2">Uso. Const.</th>
            <th rowspan="2">No. Niveles</th>
        </tr>
        <tr>
            <th>Techo</th>
            <th>Muro</th>
            <th>Piso</th>
            <th>Puertas</th>
            <th>Ventanas</th>
            <th>Inst. Hid.</th>
            <th>Inst. Sanit.</th>
            <th>Inst. Elec.</th>
        </tr>
        </thead>
        <tbody>
        <tr class="bloque-construccion">
            <td class="bloque-id">1</td>
            <td>
                {{Form::text('manifestaciones_construcciones[0][sup_construccion]')}}
            </td>
            <td>
                {{Form::text('manifestaciones_construcciones[0][tipo_construccion]')}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][techos]',[null=>'--'] + $techos)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][muros]',[null=>'--'] + $muros)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][pisos]',[null=>'--'] + $pisos)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][puertas]',[null=>'--'] + $puertas)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][ventanas]',[null=>'--'] + $ventanas)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][hidraulicas]',[null=>'--'] + $hidraulicas)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][electricas]',[null=>'--'] + $electricas)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][sanitarias]',[null=>'--'] + $sanitarias)}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][inst_especiales]',[null=>'--'] + $instEspeciales)}}
            </td>
            <td>
                {{Form::text('manifestaciones_construcciones[0][antiguedad]')}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][edo_construccion]',[null=>'--'] + $edosConstruccion)}}
            </td>
            <td>
                {{Form::text('manifestaciones_construcciones[0][avance]')}}
            </td>
            <td>
                {{Form::select('manifestaciones_construcciones[0][uso_construccion]',[null=>'--'] + $usosConstruccion)}}
            </td>
            <td>
                {{Form::text('manifestaciones_construcciones[0][num_niveles]')}}
            </td>
        </tr>
        </tbody>
    </table>
</div>
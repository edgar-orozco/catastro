<table id="datos-albercas" class="table">
    <thead>
    <tr><th colspan="6">Albercas</th></tr>
    <tr>
        <th></th>
        <th>Superficie</th>
        <th>Tipo Alberca</th>
        <th>Terminación (%)</th>
        <th>Año construcción</th>
        <th>Valor/m<sup>2</sup></th>
    </tr>
    </thead>
    <tbody class="talbercas">
    <tr class="bloque-alberca" data-pk="1">
        <td class="alberca-id">1</td>
        <td>
            <a href="javascript:void(0);"
               class="xselect superficieAlberca editable"
               data-type="text"
               data-pk="1"
               data-name="superficie_alberca"
               data-title="Click para ingresar un valor"></a>
        </td>
        <td>
            <a href="javascript:void(0);"
               class="xselect tipoAlberca editable"
               data-type="select"
               data-pk="1"
               data-name="tipoalberca"
               data-title="Click para ingresar un valor"></a>

        </td>
        <td>
            <a href="javascript:void(0);"
               class="editable avance"
               data-type="text"
               data-pk="1"
               data-name="avance"
               data-title="Ingrese el porcentaje de avance"></a>

        </td>

        <td>
            <a href="javascript:void(0);"
               class="editable antiguedad"
               data-type="text"
               data-pk="1"
               data-name="antiguedad"
               data-title="Ingrese la antigüedad en años"></a>

        </td>

        <td class="val-categoria-albercas"></td>
        <td style="width: 30px;">
            <button type="button" class="btn btn-warning pull-right borrar-alberca" data-pk="1" title="Eliminar Alberca"><i class="glyphicon glyphicon-trash"></i></button>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr style="border: none !important;">
        <td style="border: none !important;"></td>
        <td class="sup-total-albercas"></td>
        <td colspan="4" style="border: none !important;">
            <button type="button" class="btn btn-success pull-right agregar-alberca"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Agregar Alberca</button>
        </td>
    </tr>
    </tfoot>
</table>

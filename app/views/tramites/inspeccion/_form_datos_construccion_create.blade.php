<div class="datos-construccion">
    <table id="datos-construccion" class="table" style="width: 50%">
        <thead>
        <tr>
            <th >Bloque</th>
            <th >Superficie de construcción (m<sup>2</sup>)</th>
        </tr>
        </thead>
        <tbody>
        <tr class="bloque-construccion" data-pk="1">
            <td class="bloque-id">1</td>
            <td>
                <a href="javascript:void(0);"
                   class="editable supConstruccion"
                   data-type="text"
                   data-pk="1"
                   data-name="sup_construccion"
                   data-title="Click para ingresar un valor"></a>
            </td>
            <td>
                <button class="btn btn-warning pull-right borrar-construccion" data-pk="1" title="Eliminar bloque de construcción"><i class="glyphicon glyphicon-trash"></i></button>
            </td>
        </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    Sup. Albercas
                </td>
                <td >
                    <a href="javascript:void(0);"
                       class="editable sup-albercas"
                       data-type="text"
                       data-pk="sup-alberca"
                       data-name="sup_albercas"
                       data-title="Click para ingresar un valor"></a>
                </td>
            </tr>
        <tr>
            <td>Total bloques cons.</td>
            <td class="tot-bloques">1</td>
        </tr>
        <tr>
            <td>
                Total Sup. Cons.
            </td>
            <td id="total-sup-cons">
                0
            </td>
        </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-success pull-right agregar-construccion"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Agregar bloque de construcción</button>
                </td>

            </tr>
        </tfoot>
    </table>

    <input type="hidden" id="construcciones" name="datos_construccion" value="">
</div>


<div class="datos-construccion">
    <div class="col-md-12">
    <table id="datos-construccion" class="table">
        <thead>
        <tr>
            <th rowspan="2"></th>
            <th rowspan="2">Superficie</th>
            <th rowspan="2">Niveles</th>
            <th rowspan="2">Estado conservación</th>
            <th rowspan="2">Tipo de construcción</th>
            <th colspan="7">Características de la construcción</th>
            <th rowspan="2">Terminación (%)</th>
            <th rowspan="2">Año construcción</th>
            <th rowspan="2">Clase</th>
            <th rowspan="2">Valor/m<sup>2</sup></th>

        </tr>
        <tr>
            <th>Piso</th>
            <th>Techo</th>
            <th>Muro</th>
            <th>Puertas / Ventanas</th>
            <th>Inst. Hid.</th>
            <th>Inst. Sanit.</th>
            <th>Inst. Elec.</th>
        </tr>
        </thead>
        <tbody class="tcons">
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
                <a href="javascript:void(0);"
                   class="editable niveles"
                   data-type="text"
                   data-pk="1"
                   data-name="num_niveles"
                   data-title="Ingrese el número de niveles"></a>
            </td>

            <td>
                <a href="javascript:void(0);"
                   class="xselect edosConstruccion editable"
                   data-type="select"
                   data-pk="1"
                   data-name="edo_construccion"
                   data-title="Click para ingresar un valor"></a>

            </td>

            <td>

                <a href="javascript:void(0);"
                   class="xselect tiposConstruccion editable"
                   data-type="select"
                   data-pk="1"
                   data-value=""
                   data-name="tipo_construccion"
                   data-title="Click para ingresar un valor"></a>

            </td>

            <td>
                <a href="javascript:void(0);"
                   class="xselect pisos editable"
                   data-type="select"
                   data-pk="1"
                   data-name="pisos"
                   data-title="Click para ingresar un valor"></a>

            </td>

            <td>
                <a href="javascript:void(0);"
                   class="xselect techos editable"
                   data-type="select"
                   data-pk="1"
                   data-name="techos"
                   data-title="Click para ingresar un valor"></a>
            </td>
            <td>
                <a href="javascript:void(0);"
                   class="xselect muros editable"
                   data-type="select"
                   data-pk="1"
                   data-name="muros"
                   data-title="Click para ingresar un valor"></a>

            </td>
            <td>
                <a href="javascript:void(0);"
                   class="xselect puertas editable"
                   data-type="select"
                   data-pk="1"
                   data-name="puertas"
                   data-title="Click para ingresar un valor"></a>
            </td>
            <td>
                <a href="javascript:void(0);"
                   class="xselect hidraulicas editable"
                   data-type="select"
                   data-pk="1"
                   data-name="hidraulicas"
                   data-title="Click para ingresar un valor"></a>
            </td>
            <td>
                <a href="javascript:void(0);"
                   class="xselect sanitarias editable"
                   data-type="select"
                   data-pk="1"
                   data-name="sanitarias"
                   data-title="Click para ingresar un valor"></a>
            </td>

            <td>
                <a href="javascript:void(0);"
                   class="xselect electricas editable"
                   data-type="select"
                   data-pk="1"
                   data-name="electricas"
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
            <td class="categoria">
            </td>
            <td class="val-categoria">
            </td>
            <td>
                <button type="button" class="btn btn-warning pull-right borrar-construccion" data-pk="1" title="Eliminar bloque de construcción"><i class="glyphicon glyphicon-trash"></i></button>
            </td>
        </tr>
        </tbody>
        <tfoot>

        <tr style="border: none !important;">
            <td colspan="16" style="border: none !important;">
                <button type="button" class="btn btn-success pull-right agregar-construccion"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Agregar bloque de construcción</button>
            </td>
        </tr>

        </tfoot>
    </table>
    </div>


        <div class="col-md-3">
        <table id="datos-albercas" class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Tipo Alberca</th>
                    <th>Superficie</th>
                    <th>Valor/m<sup>2</sup></th>
                </tr>
            </thead>
            <tbody class="talbercas">
                <tr class="bloque-alberca">
                    <td class="alberca-id">1</td>
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
                           class="xselect superficieAlberca editable"
                           data-type="text"
                           data-pk="1"
                           data-name="superficie_alberca"
                           data-title="Click para ingresar un valor"></a>
                    </td>
                    <td class="val-categoria-albercas"></td>
                    <td style="width: 30px;">
                        <button type="button" class="btn btn-warning pull-right borrar-alberca" data-pk="1" title="Eliminar Alberca"><i class="glyphicon glyphicon-trash"></i></button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr style="border: none !important;">
                    <td colspan="4" style="border: none !important;">
                        <button type="button" class="btn btn-success pull-right agregar-alberca"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Agregar Alberca</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        </div>


    <input type="hidden" id="construcciones" name="datos_construccion" value="">
</div>




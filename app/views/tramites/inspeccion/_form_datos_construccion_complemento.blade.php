<div class="datos-construccion">
    <table id="datos-construccion" class="table">
        <thead>
        <tr>
            <th rowspan="2">Bloque</th>
            <th rowspan="2">Superficie de construcción (m<sup>2</sup>)</th>
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
        <tbody id="tbodyConstruccion">
          @if($manifestacionConstruccion->count()>0)
          @foreach($manifestacionConstruccion as $maniConstruccion)

            <tr class="bloque-construccion" data-pk="1">
                <td class="bloque-id">1</td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable supConstruccion"
                       data-type="text"
                       data-pk="1"
                       data-name="sup_construccion"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->sup_construccion}}"></a>
                </td>
                <td>

                    <a href="javascript:void(0);"
                       class="xselect tiposConstruccion editable"
                       data-type="select"
                       data-pk="1"
                       data-value=""
                       data-name="tipo_construccion"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->tipo_construccion}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect techos editable"
                       data-type="select"
                       data-pk="1"
                       data-name="techos"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->techos}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect muros editable"
                       data-type="select"
                       data-pk="1"
                       data-name="muros"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->muros}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect pisos editable"
                       data-type="select"
                       data-pk="1"
                       data-name="pisos"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->pisos}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect puertas editable"
                       data-type="select"
                       data-pk="1"
                       data-name="puertas"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->puertas}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect ventanas editable"
                       data-type="select"
                       data-pk="1"
                       data-name="ventanas"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->ventanas}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect hidraulicas editable"
                       data-type="select"
                       data-pk="1"
                       data-name="hidraulicas"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->hidraulicas}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect electricas editable"
                       data-type="select"
                       data-pk="1"
                       data-name="electricas"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->electricas}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect sanitarias editable"
                       data-type="select"
                       data-pk="1"
                       data-name="sanitarias"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->sanitarias}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect instEspeciales editable"
                       data-type="select"
                       data-pk="1"
                       data-name="inst_especiales"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->inst_especiales}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable antiguedad"
                       data-type="text"
                       data-pk="1"
                       data-name="antiguedad"
                       data-title="Ingrese la antigüedad en años"
                       value="{{$maniConstruccion->antiguedad}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect edosConstruccion editable"
                       data-type="select"
                       data-pk="1"
                       data-name="edo_construccion"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->edo_construccion}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable avance"
                       data-type="text"
                       data-pk="1"
                       data-name="avance"
                       data-title="Ingrese el porcentaje de avance"
                       value="{{$maniConstruccion->avance}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect usosConstruccion editable"
                       data-type="select"
                       data-pk="1"
                       data-name="uso_construccion"
                       data-title="Click para ingresar un valor"
                       value="{{$maniConstruccion->uso_construccion}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable niveles"
                       data-type="text"
                       data-pk="1"
                       data-name="num_niveles"
                       data-title="Ingrese el número de niveles"
                       value="{{$maniConstruccion->num_niveles}}"></a>
                </td>
                <td>
                    <button class="btn btn-warning pull-right borrar-construccion" data-pk="1" title="Eliminar bloque de construcción"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
          @endforeach
          @else
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
                       class="xselect tiposConstruccion editable"
                       data-type="select"
                       data-pk="1"
                       data-value=""
                       data-name="tipo_construccion"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect techos editable"
                       data-type="select"
                       data-pk="1"
                       data-name="techos"
                       data-title="Click para ingresar un valor"
                       value=1></a>
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
                       class="xselect pisos editable"
                       data-type="select"
                       data-pk="1"
                       data-name="pisos"
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
                       class="xselect ventanas editable"
                       data-type="select"
                       data-pk="1"
                       data-name="ventanas"
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
                       class="xselect electricas editable"
                       data-type="select"
                       data-pk="1"
                       data-name="electricas"
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
                       class="xselect instEspeciales editable"
                       data-type="select"
                       data-pk="1"
                       data-name="inst_especiales"
                       data-title="Click para ingresar un valor"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable antiguedad"
                       data-type="text"
                       data-pk="1"
                       data-name="antiguedad"
                       data-title="Ingrese la antigüedad en años"></a>

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
                       class="editable avance"
                       data-type="text"
                       data-pk="1"
                       data-name="avance"
                       data-title="Ingrese el porcentaje de avance"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect usosConstruccion editable"
                       data-type="select"
                       data-pk="1"
                       data-name="uso_construccion"
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
                    <button class="btn btn-warning pull-right borrar-construccion" data-pk="1" title="Eliminar bloque de construcción"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
          @endif
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

                <td colspan="15">
                <button class="btn btn-success pull-right agregar-construccion"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Agregar bloque de construcción</button>
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
        </tfoot>
    </table>

    <input type="hidden" id="construcciones" name="datos_construccion" value="">
</div>
<div class="col-md-6">
    <div class="form-group">
        {{Form::label('ValorCalle','MAPA DE MANZANA')}}
        <div style="width:552px;height:240px;border:1px solid #C0C0C0;">Aqui debe de ir algo</div>
        {{$errors->first('valorcalle', '<span class=text-danger>:message</span>')}}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {{Form::label('observaciones','OBSERVACIONES')}}
        {{Form::textarea('observaciones', null, ['class' => 'form-control'])}}
        {{$errors->first('observaciones', '<span class=text-danger>:message</span>')}}
    </div>
</div>

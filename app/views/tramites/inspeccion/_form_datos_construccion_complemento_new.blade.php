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
          <?php
            $num_bloque=0;
          ?>          
          @foreach($manifestacionConstruccion as $maniConstruccion)
          <?php
            $id_mani = $maniConstruccion->id;
            $num_bloque++;
          ?>
            <tr class="bloque-construccion" data-pk="{{$maniConstruccion->id}}">
                <td class="bloque-id" id="{{$id_mani}}" data-pk="{{$id_mani}}">{{$maniConstruccion->num_bloque}}</td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable supConstruccion"
                       data-type="text"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="sup_construccion"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->sup_construccion}}"></a>
                </td>

                <td>

                    <a href="javascript:void(0);"
                       class="xselect tiposConstruccion editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="tipo_construccion_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->tipo_construccion_id}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect techos editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="techo_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->techo_id}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect muros editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="muro_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->muro_id}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect pisos editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="piso_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->piso_id}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect puertas editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="puerta_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->puerta_id}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect ventanas editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="ventana_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->ventana_id}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect hidraulicas editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="hidraulicas"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->hidraulicas}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect electricas editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="electricas"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->electricas}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect sanitarias editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="sanitarias"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->sanitarias}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect instEspeciales editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="inst_especiales_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->inst_especiales_id}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable antiguedad"
                       data-type="text"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="antiguedad"
                       data-title="Ingrese la antigüedad en años"
                       data-value="{{$maniConstruccion->antiguedad}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect edosConstruccion editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="edo_construccion_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->edo_construccion_id}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable avance"
                       data-type="text"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="avance"
                       data-title="Ingrese el porcentaje de avance"
                       data-value="{{$maniConstruccion->avance}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect usosConstruccion editable"
                       data-type="select"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="uso_construccion_id"
                       data-title="Click para ingresar un valor"
                       data-value="{{$maniConstruccion->uso_construccion_id}}"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable niveles"
                       data-type="text"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="num_niveles"
                       data-title="Ingrese el número de niveles"
                       data-value="{{$maniConstruccion->num_niveles}}"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable supConstruccion"
                       data-type="text"
                       data-pk="{{$maniConstruccion->id}}"
                       data-name="id"
                       data-value="{{$maniConstruccion->id}}"
                       hidden></a>
                </td>
                <td>
                    <button class="btn btn-warning pull-right borrar-construccion" data-pk="{{$maniConstruccion->id}}" title="Eliminar bloque de construcción"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
          @endforeach
          @endif
                    <?php
           $id_mani=isset($id_mani) ? $id_mani+1 : 0;
          ?>
              <tr class="bloque-construccion" data-pk="{{$id_mani+1}}">
                <td class="bloque-id" id="{{$id_mani+1}}" data-pk="{{$id_mani+1}}">{{isset($num_bloque) ? $num_bloque+1 : 1}}</td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable supConstruccion"
                       data-type="text"
                       data-pk="{{$id_mani+1}}"
                       data-name="sup_construccion"
                       data-title="Click para ingresar un valor"></a>
                </td>
                <td>

                    <a href="javascript:void(0);"
                       class="xselect tiposConstruccion editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-value=""
                       data-name="tipo_construccion_id"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect techos editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="techo_id"
                       data-title="Click para ingresar un valor"
                       data-value="TB"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect muros editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="muro_id"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect pisos editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="piso_id"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect puertas editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="puerta_id"
                       data-title="Click para ingresar un valor"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect ventanas editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="ventana_id"
                       data-title="Click para ingresar un valor"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect hidraulicas editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="hidraulicas"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect electricas editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="electricas"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect sanitarias editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="sanitarias"
                       data-title="Click para ingresar un valor"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect instEspeciales editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="inst_especiales_id"
                       data-title="Click para ingresar un valor"></a>
                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable antiguedad"
                       data-type="text"
                       data-pk="{{$id_mani+1}}"
                       data-name="antiguedad"
                       data-title="Ingrese la antigüedad en años"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect edosConstruccion editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="edo_construccion_id"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable avance"
                       data-type="text"
                       data-pk="{{$id_mani+1}}"
                       data-name="avance"
                       data-title="Ingrese el porcentaje de avance"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="xselect usosConstruccion editable"
                       data-type="select"
                       data-pk="{{$id_mani+1}}"
                       data-name="uso_construccion_id"
                       data-title="Click para ingresar un valor"></a>

                </td>
                <td>
                    <a href="javascript:void(0);"
                       class="editable niveles"
                       data-type="text"
                       data-pk="{{$id_mani+1}}"
                       data-name="num_niveles"
                       data-title="Ingrese el número de niveles"></a>
                </td>
                <td>
                    <button class="btn btn-warning pull-right borrar-construccion" data-pk="{{$id_mani+1}}" title="Eliminar bloque de construcción"><i class="glyphicon glyphicon-trash"></i></button>
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
                       data-value="{{$consultaMani->superficie_alberca}}"
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
        {{Form::textarea('observacion', $consultaMani->observacion, ['class' => 'form-control'])}}
        {{$errors->first('observaciones', '<span class=text-danger>:message</span>')}}
    </div>
</div>

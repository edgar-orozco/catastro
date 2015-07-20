{{--ToDo: Corregir estilos--}}


<div class="row">

    <p>Con fundamento en los articulos 78, 108, 109, 110, 111, 112,113, 114 Y Art 5to Transitorio de la Ley de Hacienda
        Municipal del Estado de Tabasco en Vigor; me permito enterar el pago de Impuesto sobre el Traslado de Dominio de
        Bienes Inmuebles, mediante la siguiente Declaracion presentada en duplicado.</p>
</div>


{{-- {{Form::label('clave','Clave')}}--}}
{{Form::hidden('traslado[clave]', $predio->clave, ['class'=>'form-control'])}}
{{$errors->first('traslado[clave]', '<span class=text-danger>:message</span>')}}

{{-- {{Form::label('cuenta','Cuenta')}}--}}
{{Form::hidden('traslado[cuenta]', $predio->cuenta, ['class'=>'form-control'])}}
{{$errors->first('traslado[cuenta]', '<span class=text-danger>:message</span>')}}


<div class="row">

    {{-- <div class="form-group col-md-6">--}}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group col-md-4">

                {{Form::label('traslado[lugar]','Lugar')}}
                {{Form::input('text', 'traslado[lugar]', null, ['class'=>'form-control'] )}}
                {{$errors->first('traslado[lugar]', '<span class=text-danger>:message</span>')}}
            </div>
            <div class="form-group col-md-4">

                {{Form::label(null,'Fecha')}}<br>
                {{ $fecha = date('d/m/Y'); }}

                {{Form::hidden('traslado[fecha]', $fecha, ['class'=>'form-control'])}}
            </div>
            <div class="form-group col-md-4">

                {{Form::label('traslado[declaracion]','Declaración')}}
                <br>
                {{ Form::label('declaracionNormal', 'Normal') }}
                {{ Form::radio('traslado[declaracion]', 'Normal', false, array('id'=>'declaracionNormal')) }}
                &nbsp;&nbsp;
                {{ Form::label('declaracionComplementaria', 'Complementaria') }}
                {{ Form::radio('traslado[declaracion]', 'Complementaria', false, array('id'=>'declaracionComplementaria'))  }}
            </div>

        </div>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Contratantes</h3>
    </div>
    <div class="panel-body">
        <!--<div class="row">-->
        {{--adquiriente --}}
        <div class="form-group col-md-6">
            <h3> Adquiriente </h3>

            <div class="">
                {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
                <br>
                {{Form::label('tipo_persona','Física', ['class'=>''])}}
                {{ Form::radio('adquiriente[id_tipo]', '1', null, ['class'=>'adquiriente-radio-persona']) }}
                {{Form::label('tipo_persona','Moral', ['class'=>''])}}
                {{ Form::radio('adquiriente[id_tipo]', '2', null, ['class'=>'adquiriente-radio-persona']) }}

            </div>

            {{Form::label('adquiriente[nombres]','Nombre', ['class'=>''])}}
            {{Form::text('adquiriente[nombres]', null, ['class' => 'form-control', 'required'=>true] )}}

            <span class="adquiriente-campos-fisica">

            {{Form::label('adquiriente[apellido_paterno]','Apellido Paterno', ['class'=>''])}}
                {{Form::text('adquiriente[apellido_paterno]', null, ['class' => 'form-control'] )}}

                {{Form::label('adquiriente[apellido_materno]','Apellido Materno', ['class'=>''])}}
                {{Form::text('adquiriente[apellido_materno]', null, ['class' => 'form-control'] )}}

                {{Form::label('adquiriente[curp]','CURP', ['class'=>''])}}
                {{Form::text('adquiriente[curp]', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado'])}}

        </span>

            {{Form::label('adquiriente[rfc]','RFC', ['class'=>''])}}
            {{Form::text('adquiriente[rfc]', null, ['class' => 'form-control', 'id'=>'adquiriente-rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] )}}

        </div>
        {{--/adquiriente --}}


        {{--enajenante --}}
        <div class="form-group col-md-6">

            <h3> Enajenante </h3>

            <div>
                {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
                <br>
                {{Form::label('tipo_persona','Física', ['class'=>''])}}
                {{ Form::radio('enajenante[id_tipo]', '1', null, ['id'=>'enajenante-radio-persona-f','class'=>'enajenante-radio-persona']) }}
                {{Form::label('tipo_persona','Moral', ['class'=>''])}}
                {{ Form::radio('enajenante[id_tipo]', '2', null, ['id'=>'enajenante-radio-persona-m','class'=>'enajenante-radio-persona']) }}

            </div>

            {{Form::label('enajenante[nombres]','Nombre', ['class'=>''])}}
            {{Form::text('enajenante[nombres]', null, ['class' => 'form-control', 'required'=>true] )}}

            <span class="enajenante-campos-fisica">

        {{Form::label('enajenante[apellido_paterno]','Apellido Paterno', ['class'=>''])}}
                {{Form::text('enajenante[apellido_paterno]', null, ['class' => 'form-control'] )}}

                {{Form::label('enajenante[apellido_materno]','Apellido Materno', ['class'=>''])}}
                {{Form::text('enajenante[apellido_materno]', null, ['class' => 'form-control'] )}}

                {{Form::label('enajenante[curp]','CURP', ['class'=>''])}}
                {{Form::text('enajenante[curp]', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado' ] )}}
    </span>

            {{Form::label('enajenante[rfc]','RFC', ['class'=>''])}}
            {{Form::text('enajenante[rfc]', null, ['class' => 'form-control', 'id'=>'enajenante-rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] )}}

        </div>
        {{--/enajenante --}}
    </div>
</div>


{{--Datos del predio --}}

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos del bien inmueble</h3>
    </div>
    <div class="panel-body">
        {{Form::label('traslado[tipo_escritura]','Tipo de escritura: ')}}
        &nbsp;&nbsp;
        {{ Form::label('tipoEscrituraPublica', 'Pública') }}
        {{ Form::radio('traslado[tipo_escritura]', 'Pública', false, array('id'=>'tipoEscrituraPublica')) }}
        &nbsp;&nbsp;
        {{ Form::label('tipoEscrituraPrivada', 'Privada') }}
        {{ Form::radio('traslado[tipo_escritura]', 'Privada', false, array('id'=>'tipoEscrituraPrivada'))  }}
        &nbsp;&nbsp;
        {{ Form::label('tipoEscrituraTitulo', 'Titulo') }}
        {{ Form::radio('traslado[tipo_escritura]', 'Titulo', false, array('id'=>'tipoEscrituraTitulo'))  }}
        <br>

        <div class="form-group col-md-4">
            {{Form::label('traslado[escritura_registro]','N°. De escritura')}}
            {{Form::number('traslado[escritura_registro]', null, ['class'=>'form-control', 'min'=>0] )}}
            {{$errors->first('traslado[escritura_registro]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[escritura_volumen]','Volumen')}}
            {{Form::number('traslado[escritura_volumen]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[escritura_volumen]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[escritura_fecha]','De fecha')}}
            {{Form::input('text', 'traslado[escritura_fecha]', null, ['class'=>'form-control fecha'] )}}
            {{$errors->first('traslado[escritura_fecha]', '<span class=text-danger>:message</span>')}}
        </div>

        <div style="clear:both"></div>
        <div class="well well-sm">

            {{Form::label('','Pasada ante la fe del notario')}}
            {{$notarioEscritura}}

            <br>
            {{Form::label('','Notaría pública:')}}
            {{$notariaEscritura}}

        </div>

        <div style="clear:both"></div>
        {{Form::label('traslado[naturaleza_contrato]','Naturaleza  del Contrato')}}
        {{Form::input('text', 'traslado[naturaleza_contrato]', null, ['class'=>'form-control'] )}}
        {{$errors->first('traslado[naturaleza_contrato]', '<span class=text-danger>:message</span>')}}

        <br>

        <div style="clear:both"></div>
        <div class="well well-sm">
            {{Form::label('','Ubicacion:')}}
            {{$predio->ubicacionFiscal->ubicacion}}
            <br>

            {{Form::label('','Superficie terreno:')}}
            {{number_format($predio->superficie_terreno,2, '.', ',')}} m<sup>2</sup>
            <br>

            {{Form::label('','Superficie construcción:')}}
            {{number_format($predio->superficie_construccion,2, '.', ',')}} m<sup>2</sup>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Antecedentes de la propiedad</h3>
    </div>
    <div class="panel-body">

        {{Form::label(null,'Pasada ante la fe del notario')}}
        <select select-two="select2" placeholder="Notarias" class="select2-select" selection="notarias"
                ng-model="notarias" id="notario_antecedente_id" name="traslado[notario_antecedente_id]">
            @foreach(Notaria::all() as $notaria)
                <option value="{{ $notaria->id_notaria }}"> {{ $notaria->nombre }}
                    ( {{ $notaria->mpio['nombre_municipio'] }}, {{ $notaria->estado['nom_ent'] }})
                    ({{ $notaria->notario->nombres }} {{ $notaria->notario->apellido_paterno }} {{ $notaria->notario->apellido_materno }} )
                </option>
            @endforeach
        </select>
        {{$errors->first('municipios[]', '<span class=text-danger>:message</span>')}}

        <br>

        <div class="form-group col-md-4">
            {{Form::label('traslado[num_antecedente]','N° de escritura')}}
            {{Form::number('traslado[num_antecedente]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[num_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[volumen_antecedente]','Volumen')}}
            {{Form::number('traslado[volumen_antecedente]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[volumen_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">

            {{Form::label('traslado[fecha_antecedente]','De fecha')}}
            {{Form::input('text', 'traslado[fecha_antecedente]', null, ['class'=>'form-control fecha'] )}}
            {{$errors->first('traslado[fecha_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="form-group col-md-4">
            {{Form::label('traslado[partida_antecedente]','Partida')}}
            {{Form::text('traslado[partida_antecedente]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[partida_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[predio_antecedente]','Predio')}}
            {{Form::number('traslado[predio_antecedente]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[predio_antecedente]', '<span class=text-danger>:message</span>')}}

        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[folio_real_antecedente]','Folio')}}
            {{Form::number('traslado[folio_real_antecedente]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[folio_real_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="form-group col-md-4">
            {{Form::label('traslado[volumen_freal_antecedente]','Volumen')}}
            {{Form::number('traslado[volumen_freal_antecedente]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[volumen_freal_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>

        <div style="clear:both"></div>
        <div class="well well-sm">
            {{Form::label(null,'No. de cuenta predial:')}}
            {{$predio->cuenta}}
            <br>
            {{Form::label(null,'Regimen:')}}
            {{$predio->tipo_predio}}
            <br>
            {{Form::label(null,'Clave catastral:')}}
            {{$predio->clave}}
        </div>

        <div class="form-group col-md-4">
            {{Form::label('traslado[valor_comercial_antecedente]','Valor comercial de inmueble')}}
            {{Form::number('traslado[valor_comercial_antecedente]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[valor_comercial_antecedentre]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label(null,'Valuador con registro estatal')}}
            <select select-two="select2" placeholder="Peritos" class="select2-select" selection="valuador_num_ant"
                    ng-model="valuador_num_ant" id="valuador_num_ant" name="traslado[valuador_num_ant]">
                @foreach(Perito::all() as $perito)
                    <option value="{{ $perito->corevat}}"> ({{ $perito->corevat }}) {{ $perito->nombre }} </option>
                @endforeach
            </select>
            {{$errors->first('peritos[]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[folio_avaluo_ant]','No de folio de avaluo')}}
            {{Form::input('text', 'traslado[folio_avaluo_ant]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[folio_avaluo_ant]', '<span class=text-danger>:message</span>')}}
        </div>


    </div>
</div>


<div class="form-group col-md-6">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Liquidación vivienda</h3>
        </div>
        <div class="panel-body">
            {{Form::label('traslado[tipo_vivienda]','Tipo Vivienda')}}
            <br>
            <br>
            {{ Form::label('tipoViviendaInteresSocial', 'Interés social') }}
            {{ Form::radio('traslado[tipo_vivienda]', 'Interés social', false, array('id'=>'tipoViviendaInteresSocial')) }}
            &nbsp;&nbsp;
            {{ Form::label('tipoViviendaPopular', 'Popular') }}
            {{ Form::radio('traslado[tipo_vivienda]', 'Popular', false, array('id'=>'tipoViviendaPopular')) }}
            &nbsp;&nbsp;
            {{ Form::label('tipoViviendaOtraCaracteristica', 'Otra caracteristica') }}
            {{ Form::radio('traslado[tipo_vivienda]', 'Otra caracteristica', false, array('id'=>'tipoViviendaOtraCaracteristica')) }}

            <br>
            {{Form::label('traslado[precio_base]','Precio base')}}
            {{Form::number('traslado[precio_base]', null, ['id'=>'precioBase', 'class'=>'form-control importeTotalFactores', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>false, 'readonly'=>true] )}}
            {{$errors->first('traslado[precio_base]', '<span class=text-danger>:message</span>')}}


            {{Form::label('traslado[deduccion]','Deducción')}}
            {{Form::number('traslado[deduccion]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>false] )}}
            {{$errors->first('traslado[deduccion]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[base_gravable]','Base gravable por la que pagaron')}}
            {{Form::number('traslado[base_gravable]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>false] )}}
            {{$errors->first('traslado[base_gravable]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[diferencia_omitida]','Diferencia omitida')}}
            {{Form::number('traslado[diferencia_omitida]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>false] )}}
            {{$errors->first('traslado[diferencia_omitida]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[porcentaje_aplicarse]','Porcentaje aplicarse')}}
            {{Form::number('traslado[porcentaje_aplicarse]', null, ['id'=>'porcentajeAplicarse', 'class'=>'form-control importeTotalFactores', 'min' => 2, 'step'=>'any', 'min'=>0, 'required'=>false] )}}
            {{$errors->first('traslado[porcentaje_aplicarse]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[impuesto_enterar]','Impuesto enterar')}}
            {{Form::number('traslado[impuesto_enterar]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>false] )}}
            {{$errors->first('traslado[impuesto_enterar]', '<span class=text-danger>:message</span>')}}


            <?php
             //   print_r($predio);
            $municipioArr = explode('-', $predio->clave);
            $gid = Municipio::where('municipio', $municipioArr[1])->pluck('gid');
            $resultadog = DB::select("select sp_get_concepto_adeudo('$predio->clave','$gid')");
            foreach ($resultadog as $keyss) {
                $itemsg = explode('-', $keyss->sp_get_concepto_adeudo);
            }
            $actualizacion = Number_format($itemsg[0], 2, '.', ',');
            $recargo = Number_format($itemsg[1], 2, '.', ',');
            $gastos_ejecucion = Number_format($itemsg[2], 2, '.', ',');
            $gran_total = Number_format($itemsg[3], 2, '.', ',');
            $descuento_multa = Number_format($itemsg[4], 2, '.', ',');
            $descuento_gasto = Number_format($itemsg[5], 2, '.', ',');
            $descuento_recargo = Number_format($itemsg[6], 2, '.', ',');
            $totalConDescuentos = Number_format($itemsg[7], 2, '.', ',');
            ?>

            {{Form::label('traslado[actualizacion]','Actualización')}}
            {{Form::number('traslado[actualizacion]',  $actualizacion , ['id'=>'actualizacion', 'class'=>'form-control importeTotalFactores', 'readonly'=>true] )}}
            {{$errors->first('traslado[actualizacion]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[recargos]','Recargos')}}
            {{Form::number('traslado[recargos]',$totalConDescuentos - $actualizacion, ['id'=>'recargos', 'class'=>'form-control importeTotalFactores',  'readonly'=>true] )}}
            {{$errors->first('traslado[recargos]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[importe_total]','Importe total')}}
            {{Form::number('traslado[importe_total]', null, ['id'=>'importeTotal', 'class'=>'form-control', 'readonly'=>true] )}}
            {{$errors->first('traslado[importe_total]', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>
{{--/Datos del predio --}}
<div class="form-group col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Valores para base de pago</h3>
        </div>
        <div class="panel-body">

            {{Form::label('traslado[valor_catastral]','Valor catastral')}}
            {{Form::number('traslado[valor_catastral]', null, ['id'=>'valor_catastral','class'=>'form-control precioBase', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>true] )}}
            {{$errors->first('traslado[valor_catastral]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[valor_operacion]','Valor de operación')}}
            {{Form::number('traslado[valor_operacion]', null, ['id'=>'valor_operacion', 'class'=>'form-control precioBase', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>true] )}}
            {{$errors->first('traslado[valor_operacion]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[valor_comercial]','Valor comercial del inmueble')}}
            {{Form::number('traslado[valor_comercial]', null, ['id'=>'valor_comercial','class'=>'form-control precioBase', 'min' => 0, 'step'=>'any', 'min'=>0, 'required'=>true] )}}
            {{$errors->first('traslado[valor_comercial]', '<span class=text-danger>:message</span>')}}

            {{Form::label(null,'Valuador num')}}<br>
            <select select-two="select2" placeholder="Peritos" class="select2-select" selection="valuador_num"
                    ng-model="valuador_num" id="valuador_num" name="traslado[valuador_num]">
                @foreach(Perito::all() as $perito)
                    <option value="{{ $perito->corevat}}"> ({{ $perito->corevat }}) {{ $perito->nombre }} </option>
                @endforeach
            </select>
            {{$errors->first('peritos[]', '<span class=text-danger>:message</span>')}}
            <br>

            {{Form::label('traslado[folio_avaluo]','N° de folio de avaluo')}}
            {{Form::input('text', 'traslado[folio_avaluo]', null, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[folio_avaluo]', '<span class=text-danger>:message</span>')}}


        </div>
    </div>
</div>


{{--

    {{Form::label('traslado[seguimiento]','Seguimiento')}}
    {{Form::input('text', 'traslado[seguimiento]', null, ['class'=>'form-control'] )}}
    {{$errors->first('traslado[seguimiento]', '<span class=text-danger>:message</span>')}}



    {{Form::label('traslado[escritura_predio]','Predio')}}
    {{Form::number('traslado[escritura_predio]', null, ['class'=>'form-control'] )}}
    {{$errors->first('traslado[escritura_predio]', '<span class=text-danger>:message</span>')}}

    {{Form::label('traslado[escritura_folio]','Folio')}}
    {{Form::number('traslado[escritura_folio]', null, ['class'=>'form-control'] )}}
    {{$errors->first('traslado[escritura_folio]', '<span class=text-danger>:message</span>')}}

    {{Form::label('traslado[valuador_num_ant]','Valuador número anterior')}}
    {{Form::input('text', 'traslado[valuador_num_ant]', null, ['class'=>'form-control'] )}}
    {{$errors->first('traslado[valuador_num_ant]', '<span class=text-danger>:message</span>')}}


    {{Form::label('traslado[escritura_impuesto_desde]','Impuesto pagado del')}}
    {{Form::input('text', 'traslado[escritura_impuesto_desde]', null, ['class'=>'form-control fecha'] )}}
    {{$errors->first('traslado[escritura_impuesto_desde]', '<span class=text-danger>:message</span>')}}

    {{Form::label('traslado[escritura_impuesto_hasta]','Al')}}
    {{Form::input('text', 'traslado[escritura_impuesto_hasta]', null, ['class'=>'form-control fecha'] )}}
    {{$errors->first('traslado[escritura_impuesto_hasta]', '<span class=text-danger>:message</span>')}}

    {{Form::label('traslado[superficie_vendida]','Superficie vendida M2')}}
    {{Form::number('traslado[superficie_vendida]', null, ['class'=>'col-xs-4 form-control', 'min' => 0, 'step'=>'any', 'min'=>0, 'max'=>$predio->superficie_terreno, 'required'=>true] )}}
    {{$errors->first('traslado[superficie_vendida]', '<span class=text-danger>:message</span>')}}

    {{Form::label('traslado[superficie_construccion_vendida]','Superficie construcción vendida M2')}}
    {{Form::number('traslado[superficie_construccion_vendida]', null, ['class'=>'form-control input-medium',  'min' => 0, 'step'=>'any', 'min'=>0, 'max'=>$predio->superficie_construccion, 'required'=>true] )}}
    {{$errors->first('traslado[superficie_construccion_vendida]', '<span class=text-danger>:message</span>')}}

</div>
<div class="row col-lg-10">
    {{--macro colindancias--}}
{{--}}
{{ Form::colindancias('colindancia', $JsonColindancias) }}
</div>


--}}


@section('javascript')

    {{ HTML::script('js/select2/select2.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}
    {{ HTML::style('css/select2.min.css') }}

    {{--ver el componente de selección de fechas aún cuando no esté usando chrome--}}
    {{ HTML::script('js/bootstrap-datepicker.js') }}
    {{ HTML::script('js/bootstrap-datepicker.es.js') }}
    {{ HTML::style('css/datepicker3.css') }}

    <script>

        $("#notario_antecedente_id").select2({
            language: "es",
            placeholder: "Seleccione una notaría"
        });

        $("#valuador_num_ant").select2({
            language: "es",
            placeholder: "Seleccione un perito"
        });

        $("#valuador_num").select2({
            language: "es",
            placeholder: "Seleccione un perito"
        });

        $(".fecha").each(function (index) {

            if ($(this).val()) {
                // console.log( index + ": " + $( this ).val() );
                // $(this).parents('p').addClass('warning');
                var dateAr = $(this).val().split('-');
                var newDate = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];

                $(this).val(newDate);
            }
        });

        $('.fecha').datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1,
            clearBtn: true,
            language: "es",
            toggleActive: true,
            autoclose: true
        });
        {{--/datepicker--}}

        $(function () {
            //Cuando hay cambios en los radio buttons de los requisitos
            //adquiriente
            $('.adquiriente-radio-persona').change(function (ev) {
                var radio = $(this);
                if (radio.val() == '1') {
                    $('.adquiriente-campos-fisica').show();
                    $('.adquiriente-tipo_persona').val('1');
                    $('#adquiriente-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                }
                else if (radio.val() == '2') {
                    $('.adquiriente-campos-fisica').hide();
                    $('.adquiriente-tipo_persona').val('2');
                    $('#adquiriente-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                }
            });

            //Cuando hay cambios en los radio buttons de los requisitos
            //enajenante
            $('.enajenante-radio-persona').change(function (ev) {
                var radio = $(this);
                if (radio.val() == '1') {
                    $('.enajenante-campos-fisica').show();
                    $('.enajenante-tipo_persona').val('1');
                    $('#enajenante-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                }
                else if (radio.val() == '2') {
                    $('.enajenante-campos-fisica').hide();
                    $('.enajenante-tipo_persona').val('2');
                    $('#enajenante-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                }
            });

           /* Se debe tomar el valor mayor de los ingresados en los campos de la sección Valores para base de pago
            (ver referencia de campos en el ticket: #98251408)
            el valor mayor de los tres campos:
                    valor_catastral
            valor_operacion
            valor_comercial
            debe ponerse en el campo que dice Precio base del impuesto en la sección Liquidación de vivienda
            y debe ser de sólo lectura una vez que se ha realizado la peración.
                    El evento que desencadena las operaciones es el evento onchange de cada uno de los tres campos.*/
            $(".precioBase").change(function () {
               var valorCatastral =$("#valor_catastral").val();
               var valorOperacion = $("#valor_operacion").val();
               var  valorComercial = $("#valor_comercial").val();

                $("#precioBase").val(Math.max(valorCatastral, valorOperacion, valorComercial));
                $(".importeTotalFactores").change();
            });




            /*El importe total es la suma de los montos que aparecen en los siguientes campos de la sección Liquidación vivienda
            (Ver referencia de campos en ticket #98251408)
            importe total = porcentaje_aplicarse/100 * precio_base + actualizacion + recargos
            El porcentaje_aplicarse no debe ser menor al 2%
               */
            $(".importeTotalFactores").change(function () {

                var porcentajeAplicarse =Number($("#porcentajeAplicarse").val());
                var precioBase = Number($("#precioBase").val());
                var actualizacion = Number($("#actualizacion").val());
                var recargos = Number($("#recargos").val());

                var importeTotal = porcentajeAplicarse/100*precioBase+actualizacion+recargos;

                $("#importeTotal").val(importeTotal);
            });





        });
    </script>

@stop

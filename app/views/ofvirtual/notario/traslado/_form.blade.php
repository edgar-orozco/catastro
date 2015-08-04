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
                {{Form::label('tipo_persona','Tipo de persona')}}
                <br>
                {{Form::label('tipo_persona','Física')}}
                {{ Form::radio('adquiriente[id_tipo]', '1', null, ['class'=>'adquiriente-radio-persona', 'id'=>'adquirientePersonaFisica']) }}
                {{Form::label('tipo_persona','Moral')}}
                {{ Form::radio('adquiriente[id_tipo]', '2', null, ['class'=>'adquiriente-radio-persona',  'id'=>'adquirientePersonaMoral']) }}

            </div>

            {{Form::label('adquiriente[curp]','CURP', ['class'=>'adquiriente-campos-fisica'])}}
            {{Form::text('adquiriente[curp]', null, ['class' => 'form-control adquiriente-campos-fisica', 'id'=>'adquiriente-curp', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado'])}}

            {{Form::label('adquiriente[rfc]','RFC', ['class'=>''])}}
            {{Form::text('adquiriente[rfc]', null, ['class' => 'form-control', 'id'=>'adquiriente-rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] )}}

            {{Form::label('adquiriente[nombres]','Nombre', ['class'=>''])}}
            {{Form::text('adquiriente[nombres]', null, ['class' => 'form-control', 'id'=>'adquiriente-nombres', 'required'=>true] )}}

            <span class="adquiriente-campos-fisica">

            {{Form::label('adquiriente[apellido_paterno]','Apellido Paterno', ['class'=>''])}}
                {{Form::text('adquiriente[apellido_paterno]', null, ['class' => 'form-control', 'id'=>'adquiriente-apellido_paterno'] )}}

                {{Form::label('adquiriente[apellido_materno]','Apellido Materno', ['class'=>''])}}
                {{Form::text('adquiriente[apellido_materno]', null, ['class' => 'form-control', 'id'=>'adquiriente-apellido_materno'] )}}

        </span>


        </div>
        {{--/adquiriente --}}


        {{--enajenante --}}
        <div class="form-group col-md-6">

            <h3> Enajenante </h3>

            <div>
                {{Form::label('tipo_persona','Tipo de persona')}}
                <br>
                {{Form::label('tipo_persona','Física')}}
                {{ Form::radio('enajenante[id_tipo]', '1', null, ['id'=>'enajenantePersonaFisica','class'=>'enajenante-radio-persona']) }}
                {{Form::label('tipo_persona','Moral')}}
                {{ Form::radio('enajenante[id_tipo]', '2', null, ['id'=>'enajenantePersonaMoral','class'=>'enajenante-radio-persona']) }}

            </div>


            {{Form::label('enajenante[curp]','CURP', ['class'=>'enajenante-campos-fisica'])}}
            {{Form::text('enajenante[curp]', null, ['id'=>'enajenante-curp','class' => 'form-control enajenante-campos-fisica', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado' ] )}}


            {{Form::label('enajenante[rfc]','RFC', ['class'=>''])}}
            {{Form::text('enajenante[rfc]', null, ['class' => 'form-control', 'id'=>'enajenante-rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] )}}


            {{Form::label('enajenante[nombres]','Nombre', ['class'=>''])}}
            {{Form::text('enajenante[nombres]', null, ['class' => 'form-control', 'id'=>'enajenante-nombres', 'required'=>true] )}}

            <span class="enajenante-campos-fisica">

                 {{Form::label('enajenante[apellido_paterno]','Apellido Paterno', ['class'=>''])}}
                {{Form::text('enajenante[apellido_paterno]', null, ['class' => 'form-control', 'id'=>'enajenante-apellido_paterno'] )}}

                {{Form::label('enajenante[apellido_materno]','Apellido Materno', ['class'=>''])}}
                {{Form::text('enajenante[apellido_materno]', null, ['class' => 'form-control', 'id'=>'enajenante-apellido_materno'] )}}

            </span>

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
            {{Form::number('traslado[escritura_volumen]', null, ['class'=>'form-control', 'min'=>0] )}}
            {{$errors->first('traslado[escritura_volumen]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[escritura_fecha]','De fecha')}}
            {{Form::input('text', 'traslado[escritura_fecha]', null, ['class'=>'form-control fecha' ] )}}
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
        <div class="form-group col-md-4">
            {{Form::label('traslado[ubicacion]','Ubicacion')}}
            {{Form::input('text', 'traslado[ubicacion]', $predio->ubicacionFiscal->ubicacion, ['class'=>'form-control'] )}}
            {{$errors->first('traslado[ubicacion]', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="form-group col-md-4">
            {{Form::label('traslado[superficie_terreno]','Superficie terreno (m2)')}}
            {{Form::number('traslado[superficie_terreno]', $predio->superficie_terreno, ['class'=>'form-control', 'min'=>0, 'step'=>'any'] )}}
            {{$errors->first('traslado[superficie_terreno]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[superficie_construccion]','Superficie construcción (m2)')}}
            {{Form::number('traslado[superficie_construccion]', $predio->superficie_construccion, ['class'=>'form-control', 'min'=>0, 'step'=>'any'] )}}
            {{$errors->first('traslado[superficie_construccion]', '<span class=text-danger>:message</span>')}}

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
                <option value="{{ $notaria->id_notario }}"> {{ $notaria->nombre }}
                    ( {{ $notaria->mpio['nombre_municipio'] }}, {{ $notaria->estado['nom_ent'] }})
                    ({{ $notaria->notario->nombres }} {{ $notaria->notario->apellido_paterno }} {{ $notaria->notario->apellido_materno }}
                    )
                </option>
            @endforeach
        </select>
        {{$errors->first('municipios[]', '<span class=text-danger>:message</span>')}}

        <br>

        <div class="form-group col-md-4">
            {{Form::label('traslado[num_antecedente]','N° de escritura')}}
            {{Form::number('traslado[num_antecedente]', null, ['class'=>'form-control', 'min'=>0] )}}
            {{$errors->first('traslado[num_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[volumen_antecedente]','Volumen')}}
            {{Form::number('traslado[volumen_antecedente]', null, ['class'=>'form-control', 'min'=>0] )}}
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
            {{Form::number('traslado[predio_antecedente]', null, ['class'=>'form-control', 'min'=>0] )}}
            {{$errors->first('traslado[predio_antecedente]', '<span class=text-danger>:message</span>')}}

        </div>
        <div class="form-group col-md-4">
            {{Form::label('traslado[folio_real_antecedente]','Folio')}}
            {{Form::number('traslado[folio_real_antecedente]', null, ['class'=>'form-control', 'min'=>0] )}}
            {{$errors->first('traslado[folio_real_antecedente]', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="form-group col-md-4">
            {{Form::label('traslado[volumen_freal_antecedente]','Volumen')}}
            {{Form::number('traslado[volumen_freal_antecedente]', null, ['class'=>'form-control', 'min'=>0] )}}
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
            {{Form::number('traslado[valor_comercial_antecedente]', null, ['class'=>'form-control', 'min'=>0] )}}
            {{$errors->first('traslado[valor_comercial_antecedentre]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label(null,'Valuador con registro estatal')}}
            <select select-two="select2" placeholder="Peritos" class="select2-select" selection="valuador_num_ant"
                    ng-model="valuador_num_ant" id="valuador_num_ant" name="traslado[valuador_num_ant]" style="max-width: 350px">
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
            {{Form::number('traslado[precio_base]', null, ['id'=>'precio_base', 'class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[precio_base]', '<span class=text-danger>:message</span>')}}


            {{Form::label('traslado[deduccion]','Deducción')}}
            {{Form::number('traslado[deduccion]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[deduccion]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[base_gravable]','Base gravable por la que pagaron')}}
            {{Form::number('traslado[base_gravable]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any',  'required'=>true] )}}
            {{$errors->first('traslado[base_gravable]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[diferencia_omitida]','Diferencia omitida')}}
            {{Form::number('traslado[diferencia_omitida]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[diferencia_omitida]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[porcentaje_aplicarse]','Porcentaje aplicarse 2%')}}
            {{Form::number('traslado[porcentaje_aplicarse]', null, ['id'=>'porcentajeAplicarse', 'class'=>'form-control', 'step'=>'any', 'min'=>2, 'max'=>100, 'required'=>true] )}}
            {{$errors->first('traslado[porcentaje_aplicarse]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[impuesto_enterar]','Impuesto enterar')}}
            {{Form::number('traslado[impuesto_enterar]', null, ['class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[impuesto_enterar]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[actualizacion]','Actualización')}}
            {{Form::number('traslado[actualizacion]',  null , ['id'=>'actualizacion', 'class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[actualizacion]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[recargos]','Recargos')}}
            {{Form::number('traslado[recargos]',null, ['id'=>'recargos', 'class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[recargos]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[importe_total]','Importe total')}}
            {{Form::number('traslado[importe_total]', null, ['id'=>'importeTotal', 'class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
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
            {{Form::number('traslado[valor_catastral]', null, ['id'=>'valor_catastral','class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[valor_catastral]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[valor_operacion]','Valor de operación')}}
            {{Form::number('traslado[valor_operacion]', null, ['id'=>'valor_operacion', 'class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
            {{$errors->first('traslado[valor_operacion]', '<span class=text-danger>:message</span>')}}

            {{Form::label('traslado[valor_comercial]','Valor comercial del inmueble')}}
            {{Form::number('traslado[valor_comercial]', null, ['id'=>'valor_comercial','class'=>'form-control', 'min' => 0, 'step'=>'any', 'required'=>true] )}}
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



@section('javascript')

    {{ HTML::script('js/select2/select2.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}
    {{ HTML::style('css/select2.min.css') }}

    {{--ver el componente de selección de fechas aún cuando no esté usando chrome--}}
    {{ HTML::script('js/bootstrap-datepicker.js') }}
    {{ HTML::script('js/bootstrap-datepicker.es.js') }}
    {{ HTML::style('css/datepicker3.css') }}

    {{ HTML::script('js/jquery/jquery-ui-autocomplete.min.js') }}
    {{ HTML::style('js/jquery/jquery-ui.css') }}

    <script>

        $('.adquiriente-radio-persona').each(function() {
            var chb = $('#adquirientePersonaMoral');
            if (chb.is(':checked')) {
                return false;
            }
            else{
                $('#adquirientePersonaFisica').prop("checked", true);
                $('#adquirientePersonaFisica').trigger( "click" );
            }
        });
        $('.enajenante-radio-persona').each(function() {
            var chb = $('#enajenantePersonaMoral');
            if (chb.is(':checked')) {
                return false;
            }
            else{
                console.log('no checked');
                $("#enajenantePersonaFisica").prop("checked", true);
                $('#enajenantePersonaFisica').trigger( "click" );
            }
        });




        $("#notario_antecedente_id").select2({
            language: "es",
            placeholder: "Seleccione una notaría",
            width: 'resolve'
        });

        $("#valuador_num_ant").select2({
            language: "es",
            placeholder: "Seleccione un perito",
            width: 'resolve'
        });

        $("#valuador_num").select2({
            language: "es",
            placeholder: "Seleccione un perito",
            width: 'resolve'
        });

        $(".fecha").each(function (index) {

            if ($(this).val()) {
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
            autoclose: true,
            endDate: '0d'
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

                    //Habilitamos el autocomplete del curp
                    $("#adquiriente-curp").autocomplete("enable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#adquiriente-rfc").autocomplete("disable");

                }
                else if (radio.val() == '2') {
                    $('.adquiriente-campos-fisica').hide();
                    $('.adquiriente-tipo_persona').val('2');
                    $('#adquiriente-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

                    //Habilitamos el autocomplete del curp
                    $("#adquiriente-curp").autocomplete("disable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#adquiriente-rfc").autocomplete("enable");
                }
            });


            //Estas son las opciones con las que se construye el autocomplete, como son comunes a los dos inputs rfc y curp se sacan para reutlizar
            var autoCompleteOptsAdquiriente = {
                source: "/ofvirtual/notario/traslado/adquiriente", //Ruta al controlador que provee los resultados de la busqueda
                minLength: 8, //Empezamos a mandar los teclazos si han tecleado 8 caracteres
                select: function (event, ui) {
                    //Al seleccionar un valor de los desplegados rellenamos los campos
                    $('#adquiriente-curp').val(ui.item.curp);
                    $('#adquiriente-rfc').val(ui.item.rfc);
                    $('#adquiriente-nombres').val(ui.item.nombres);
                    $('#adquiriente-apellido_paterno').val(ui.item.apellido_paterno);
                    $('#adquiriente-apellido_materno').val(ui.item.apellido_materno);
                    return false;
                }
            };
            //Se crea autocompleter de CURP
            $("#adquiriente-curp").autocomplete(autoCompleteOptsAdquiriente).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.curp + "<br>" + "<span class='nombre-coincidencia'><i class='glyphicon glyphicon-user'></i><small> " + item.nombrec + "</small><span></a>")
                        .appendTo(ul);
            };
            //Se crea autocompleter de RFC
            $("#adquiriente-rfc").autocomplete(autoCompleteOptsAdquiriente).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.rfc + "<br>" + "<span class='nombre-coincidencia'><i class='glyphicon glyphicon-user'></i> <small>" + item.nombrec + "</small><span></a>")
                        .appendTo(ul);
            };
            //por default es persona física por lo que el autocomplete lo deshabilitamos
            $("#adquiriente-rfc").autocomplete("disable");

            //Cuando hay cambios en los radio buttons de los requisitos
            //enajenante
            $('.enajenante-radio-persona').change(function (ev) {
                var radio = $(this);
                if (radio.val() == '1') {
                    $('.enajenante-campos-fisica').show();
                    $('.enajenante-tipo_persona').val('1');
                    $('#enajenante-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');

                    //Habilitamos el autocomplete del curp
                    $("#enajenante-curp").autocomplete("enable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#enajenante-rfc").autocomplete("disable");
                }
                else if (radio.val() == '2') {
                    $('.enajenante-campos-fisica').hide();
                    $('.enajenante-tipo_persona').val('2');
                    $('#enajenante-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

                    //Habilitamos el autocomplete del curp
                    $("#enajenante-curp").autocomplete("disable");
                    //Deshabilitamos el autocomplete del rfc
                    $("#enajenante-rfc").autocomplete("enable");
                }
            });

            //Estas son las opciones con las que se construye el autocomplete, como son comunes a los dos inputs rfc y curp se sacan para reutlizar
            var autoCompleteOptsEnajenante = {
                source: "/ofvirtual/notario/traslado/enajenante", //Ruta al controlador que provee los resultados de la busqueda
                minLength: 8, //Empezamos a mandar los teclazos si han tecleado 8 caracteres
                select: function (event, ui) {
                    //Al seleccionar un valor de los desplegados rellenamos los campos
                    $('#enajenante-curp').val(ui.item.curp);
                    $('#enajenante-rfc').val(ui.item.rfc);
                    $('#enajenante-nombres').val(ui.item.nombres);
                    $('#enajenante-apellido_paterno').val(ui.item.apellido_paterno);
                    $('#enajenante-apellido_materno').val(ui.item.apellido_materno);
                    return false;
                }
            };
            //Se crea autocompleter de CURP
            $("#enajenante-curp").autocomplete(autoCompleteOptsEnajenante).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.curp + "<br>" + "<span class='nombre-coincidencia'><i class='glyphicon glyphicon-user'></i><small> " + item.nombrec + "</small><span></a>")
                        .appendTo(ul);
            };
            //Se crea autocompleter de RFC
            $("#enajenante-rfc").autocomplete(autoCompleteOptsEnajenante).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.rfc + "<br>" + "<span class='nombre-coincidencia'><i class='glyphicon glyphicon-user'></i> <small>" + item.nombrec + "</small><span></a>")
                        .appendTo(ul);
            };
            //por default es persona física por lo que el autocomplete lo deshabilitamos
            $("#enajenante-rfc").autocomplete("disable");
        });


    </script>
@stop

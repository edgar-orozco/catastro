{{--ToDo: Corregir estilos--}}

<div class="row">


    <table class="table table-striped">
        <tr>
            <th class="text-right"><b>Clave catastral:</b></th>
            <td>{{$predio->clave}}</td>
        </tr>
        <tr>
            <th class="text-right"><b>Cuenta catastral:</b></th>
            <td>{{$predio->cuenta}}</td>
        </tr>
        <tr>
            <th class="text-right"><b>Tipo predio:</b></th>
            <td>{{$predio->tipo_predio}}</td>
        </tr>
        <tr>
            <th class="text-right"><b>Ubicacion:</b></th>
            <td>{{$predio->ubicacionFiscal->ubicacion}}</td>
        </tr>
        <tr>
            <th class="text-right"><b>Superficie terreno:</b></th>
            <td>{{number_format($predio->superficie_terreno,2, '.', ',')}} m<sup>2</sup></td>
        </tr>
        <tr>
            <th class="text-right"><b>Superficie construcción:</b></th>
            <td>{{number_format($predio->superficie_construccion,2, '.', ',')}} m<sup>2</sup></td>
        </tr>
    </table>

</div>

{{-- {{Form::label('clave','Clave')}}--}}
{{Form::hidden('traslado[clave]', $predio->clave, ['class'=>'form-control'])}}
{{$errors->first('traslado[clave]', '<span class=text-danger>:message</span>')}}

{{-- {{Form::label('cuenta','Cuenta')}}--}}
{{Form::hidden('traslado[cuenta]', $predio->cuenta, ['class'=>'form-control'])}}
{{$errors->first('traslado[cuenta]', '<span class=text-danger>:message</span>')}}

<div class="row">
    {{--Comprador --}}
    <div class="form-group col-md-6">
        <h1> Comprador </h1>

        <div class="">
            {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
            <br>
            {{Form::label('tipo_persona','Física', ['class'=>''])}}
            {{ Form::radio('comprador[id_tipo]', '1', null, ['class'=>'comprador-radio-persona']) }}
            {{Form::label('tipo_persona','Moral', ['class'=>''])}}
            {{ Form::radio('comprador[id_tipo]', '2', null, ['class'=>'comprador-radio-persona']) }}

        </div>

        {{Form::label('comprador[nombres]','Nombre', ['class'=>''])}}
        {{Form::text('comprador[nombres]', null, ['class' => 'form-control', 'required'=>true] )}}

        <span class="comprador-campos-fisica">

            {{Form::label('comprador[apellido_paterno]','Apellido Paterno', ['class'=>''])}}
            {{Form::text('comprador[apellido_paterno]', null, ['class' => 'form-control'] )}}

            {{Form::label('comprador[apellido_materno]','Apellido Materno', ['class'=>''])}}
            {{Form::text('comprador[apellido_materno]', null, ['class' => 'form-control'] )}}

            {{Form::label('comprador[curp]','CURP', ['class'=>''])}}
            {{Form::text('comprador[curp]', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado'])}}

        </span>

        {{Form::label('comprador[rfc]','RFC', ['class'=>''])}}
        {{Form::text('comprador[rfc]', null, ['class' => 'form-control', 'id'=>'comprador-rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] )}}

    </div>
    {{--/Comprador --}}


    {{--Vendedor --}}
    <div class="form-group col-md-6">

        <h1> Vendedor </h1>

        <div>
            {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
            <br>
            {{Form::label('tipo_persona','Física', ['class'=>''])}}
            {{ Form::radio('vendedor[id_tipo]', '1', null, ['id'=>'vendedor-radio-persona-f','class'=>'vendedor-radio-persona']) }}
            {{Form::label('tipo_persona','Moral', ['class'=>''])}}
            {{ Form::radio('vendedor[id_tipo]', '2', null, ['id'=>'vendedor-radio-persona-m','class'=>'vendedor-radio-persona']) }}

        </div>

        {{Form::label('vendedor[nombres]','Nombre', ['class'=>''])}}
        {{Form::text('vendedor[nombres]', null, ['class' => 'form-control', 'required'=>true] )}}

        <span class="vendedor-campos-fisica">

        {{Form::label('vendedor[apellido_paterno]','Apellido Paterno', ['class'=>''])}}
            {{Form::text('vendedor[apellido_paterno]', null, ['class' => 'form-control'] )}}

            {{Form::label('vendedor[apellido_materno]','Apellido Materno', ['class'=>''])}}
            {{Form::text('vendedor[apellido_materno]', null, ['class' => 'form-control'] )}}

            {{Form::label('vendedor[curp]','CURP', ['class'=>''])}}
            {{Form::text('vendedor[curp]', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado' ] )}}
    </span>

        {{Form::label('vendedor[rfc]','RFC', ['class'=>''])}}
        {{Form::text('vendedor[rfc]', null, ['class' => 'form-control', 'id'=>'vendedor-rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] )}}

    </div>
    {{--/Vendedor --}}
</div>


{{--Datos del predio --}}

<div class="form-group row">
    <div class="row col-lg-10">
        <h1>Datos del predio</h1>
    </div>

    <div class="row col-xs-4">
        {{Form::label('traslado[superficie_vendida]','Superficie vendida M2')}}
        {{Form::number('traslado[superficie_vendida]', null, ['class'=>'col-xs-4 form-control', 'min' => 0, 'step'=>'any', 'min'=>0, 'max'=>$predio->superficie_terreno, 'required'=>true] )}}
        {{$errors->first('traslado[superficie_vendida]', '<span class=text-danger>:message</span>')}}

        {{Form::label('traslado[superficie_construccion_vendida]','Superficie construcción vendida M2')}}
        {{Form::number('traslado[superficie_construccion_vendida]', null, ['class'=>'form-control input-medium',  'min' => 0, 'step'=>'any', 'min'=>0, 'max'=>$predio->superficie_construccion, 'required'=>true] )}}
        {{$errors->first('traslado[superficie_construccion_vendida]', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="row col-lg-10">
        {{--macro colindancias--}}
        {{ Form::colindancias('colindancia', $JsonColindancias) }}
    </div>
</div>
{{--/Datos del predio --}}
<br>
<div class="row">
    <div class="row col-lg-10">
        <h1>Datos de la escritura precedente</h1>
    </div>
    <div class="row col-xs-4">
        {{Form::label('traslado[escritura_fecha]','Escritura de fecha')}}
        {{Form::input('text', 'traslado[escritura_fecha]', null, ['class'=>'form-control fecha'] )}}
        {{$errors->first('traslado[escritura_fecha]', '<span class=text-danger>:message</span>')}}

        {{Form::label('traslado[escritura_registro]','N° registro')}}
        {{Form::number('traslado[escritura_registro]', null, ['class'=>'form-control'] )}}
        {{$errors->first('traslado[escritura_registro]', '<span class=text-danger>:message</span>')}}

        {{Form::label('traslado[escritura_predio]','Predio')}}
        {{Form::number('traslado[escritura_predio]', null, ['class'=>'form-control'] )}}
        {{$errors->first('traslado[escritura_predio]', '<span class=text-danger>:message</span>')}}

        {{Form::label('traslado[escritura_folio]','Folio')}}
        {{Form::number('traslado[escritura_folio]', null, ['class'=>'form-control'] )}}
        {{$errors->first('traslado[escritura_folio]', '<span class=text-danger>:message</span>')}}

        {{Form::label('traslado[escritura_volumen]','Volumen')}}
        {{Form::number('traslado[escritura_volumen]', null, ['class'=>'form-control'] )}}
        {{$errors->first('traslado[escritura_volumen]', '<span class=text-danger>:message</span>')}}

        {{Form::label('traslado[escritura_impuesto_desde]','Impuesto pagado del')}}
        {{Form::input('text', 'traslado[escritura_impuesto_desde]', null, ['class'=>'form-control fecha'] )}}
        {{$errors->first('traslado[escritura_impuesto_desde]', '<span class=text-danger>:message</span>')}}

        {{Form::label('traslado[escritura_impuesto_hasta]','Al')}}
        {{Form::input('text', 'traslado[escritura_impuesto_hasta]', null, ['class'=>'form-control fecha'] )}}
        {{$errors->first('traslado[escritura_impuesto_hasta]', '<span class=text-danger>:message</span>')}}

    </div>
</div>
<br>

@section('javascript')

    {{--ver el componente de selección de fechas aún cuando no esté usando chrome--}}
    {{ HTML::script('js/bootstrap-datepicker.js') }}
    {{ HTML::script('js/bootstrap-datepicker.es.js') }}
    {{ HTML::style('css/datepicker3.css') }}

    <script>


        $( ".fecha" ).each(function( index ) {

            if( $(this).val() ) {
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
            //comprador
            $('.comprador-radio-persona').change(function (ev) {
                var radio = $(this);
                if (radio.val() == '1') {
                    $('.comprador-campos-fisica').show();
                    $('.comprador-tipo_persona').val('1');
                    $('#comprador-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                }
                else if (radio.val() == '2') {
                    $('.comprador-campos-fisica').hide();
                    $('.comprador-tipo_persona').val('2');
                    $('#comprador-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                }
            });

            //Cuando hay cambios en los radio buttons de los requisitos
            //vendedor
            $('.vendedor-radio-persona').change(function (ev) {
                var radio = $(this);
                if (radio.val() == '1') {
                    $('.vendedor-campos-fisica').show();
                    $('.vendedor-tipo_persona').val('1');
                    $('#vendedor-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                }
                else if (radio.val() == '2') {
                    $('.vendedor-campos-fisica').hide();
                    $('.vendedor-tipo_persona').val('2');
                    $('#vendedor-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                }
            });

        });
    </script>

@stop

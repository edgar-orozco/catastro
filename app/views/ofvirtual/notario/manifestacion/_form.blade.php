<div class="row">
        <P>DE CONFORMIDAD CON LOS ARTICULOS 7,15,16,19,23,44 Y 66 DE LA LEY DE CATASTRO DEL ESTADO DE TABASCO; 5,6,7,15,18
            Y 22 DE SU REGLAMENTO</P>
    <br/>
</div>

<div class="row">
    @include('ofvirtual.notario.manifestacion._form_id_documento', ['listaMunicipios'])
</div>

<fieldset><legend>Propietario</legend>
    @include('ofvirtual.notario.manifestacion._form_persona_inline',['instancia'=>'enajenante'])
</fieldset>

<fieldset><legend>Vendedor</legend>
    @include('ofvirtual.notario.manifestacion._form_persona_inline',['instancia'=>'adquiriente'])
</fieldset>


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
    {{ HTML::script('js/jquery/jquery.mask.min.js') }}

    <script>
        $(function () {

            //Selectores autocompletables
            $(".select2").select2({
                language: "es",
                placeholder: "-- Seleccione",
                allowClear: true,
                dropdownAutoWidth: true,
                width: 'resolve'
            });

            //Mascaras datos de ids de documento
            $('.cuenta-predio').mask("000000");
            $('.clave-zona').mask("000");
            $('.clave-manzana').mask("0000");
            $('.clave-predio').mask("000000");

            $('.cuenta-afectada').mask("000000-S", {
                translation: {S: {pattern: /[RUru]/}}
            });

            $('.tipo-predio').mask("S", {
                translation: {S: {pattern: /[RUru]/}}
            });

            //Clicks de tipo de persona
            $('.radio-persona').click(function(){
                var radio = $(this);
                var instancia = radio.data('instancia');
                var tipo = radio.val();
                setTipoPersona(instancia, tipo);
            });

            /**
             * Setea el tipo de persona, dada la instancia y el tipo hace los cambios necesarios en el UI
             * @param instancia
             * @param tipo
             */
            var setTipoPersona = function(instancia, tipo){
                console.log("Instancia %s, Tipo: %s",instancia, tipo);
                if(tipo == '2') //se trata de click en el boton de moral
                {
                    $('.'+instancia+'-campos-fisica').hide();
                    $('#'+instancia+'-apellido_paterno').removeAttr('required');
                    $('#'+instancia+'-curp').removeAttr('required');
                    $('#'+instancia+'-rfc').attr('required',true);
                    $('#'+instancia+'-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

                    $('#'+instancia+'-nombres').attr('size',60);
                }
                else
                {
                    $('.'+instancia+'-campos-fisica').show();
                    $('#'+instancia+'-apellido_paterno').attr('required',true);
                    $('#'+instancia+'-curp').attr('required',true);
                    $('#'+instancia+'-rfc').removeAttr('required',true);
                    $('#'+instancia+'-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                    $('#'+instancia+'-nombres').attr('size',25);
                }
            }

            //Si hay un tipo default ejecuta el seteo en la interfaz
            $('.radio-persona').each(function(){
                var radio = $(this);
                var instancia = radio.data('instancia');
                var tipo = radio.val();
                if(radio.is(":checked")) {
                    setTipoPersona(instancia, tipo);
                }
            });
        });
    </script>
@stop
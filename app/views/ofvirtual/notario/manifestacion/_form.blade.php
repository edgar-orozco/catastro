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
    <h4>Domicilio:</h4>
    @include('ofvirtual.notario.manifestacion._form_persona_domicilio',['instancia'=>'enajenante'])
</fieldset>

<fieldset><legend>Vendedor</legend>
    @include('ofvirtual.notario.manifestacion._form_persona_inline',['instancia'=>'adquiriente'])
    <h4>Domicilio:</h4>
    @include('ofvirtual.notario.manifestacion._form_persona_domicilio',['instancia'=>'adquiriente'])
</fieldset>


<fieldset><legend>Dirección del predio</legend>
    @include('ofvirtual.notario.manifestacion._form_direccion_predio',['instancia'=>'direccion_predio'])
</fieldset>

<fieldset><legend>Colindancias</legend>
    {{Form::colindancias('colindancias', $JsonColindancias)}}
</fieldset>

<fieldset><legend>Datos del predio</legend>
    @include('ofvirtual.notario.manifestacion._form_datos_predio',['instancia'=>'manifestacion'])
</fieldset>

<fieldset><legend>Datos de la construcción</legend>
    @include('ofvirtual.notario.manifestacion._form_datos_construccion',['instancia'=>'manifestacion'])
</fieldset>



@section('javascript')

    {{ HTML::script('js/select2/select2.full.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}
    {{ HTML::style('css/select2.min.css') }}

    {{--ver el componente de selección de fechas aún cuando no esté usando chrome--}}
    {{ HTML::script('js/bootstrap-datepicker.js') }}
    {{ HTML::script('js/bootstrap-datepicker.es.js') }}
    {{ HTML::style('css/datepicker3.css') }}

    {{ HTML::script('js/jquery/jquery-ui-autocomplete.min.js') }}
    {{ HTML::style('js/jquery/jquery-ui.css') }}
    {{ HTML::script('js/jquery/jquery.mask.min.js') }}

    {{-- X-Editable--}}
    {{ HTML::script('js/bootstrap-editable.min.js') }}
    {{ HTML::style('css/bootstrap-editable.css') }}

    <script>
        //Fuentes de datos para selects del xeditable
        var techos = {{json_encode((array)$techos)}};
        var pisos = {{json_encode((array)$pisos)}};
        var ventanas = {{json_encode((array)$ventanas)}};
        var muros = {{json_encode((array)$muros)}};
        var puertas = {{json_encode((array)$puertas)}};
        var hidraulicas = {{json_encode((array)$hidraulicas)}};
        var sanitarias = {{json_encode((array)$sanitarias)}};
        var electricas = {{json_encode((array)$electricas)}};
        var instEspeciales = {{json_encode((array)$instEspeciales)}};
        var usosConstruccion = {{json_encode((array)$usosConstruccion)}};
        var edosConstruccion = {{json_encode((array)$edosConstruccion)}};
        var tiposConstruccion = {{json_encode((array)$tiposConstruccion)}};
        var setEditables = null;
        var registrosConstrucciones = {};

        var actualiza = function(response, valor){
            var pk = $(this).data('pk');
            var nombre = $(this).data('name');
            console.log("En el campo %s de la fila %s se puso este nuevo valor %s", nombre, pk, valor);
            if(pk in registrosConstrucciones){
                var registro = registrosConstrucciones[pk];
                eval('registro.'+nombre+' = valor');
            }
            else{
                var registro = {};
                eval('registro.'+nombre+' = valor');
                registrosConstrucciones[pk] = registro;
            }
        }

        /**
         * Valida números enteros positivos
         */
        var validaEnteroPositivo = function(value){
            var num=/^-?[0-9]+$/;
            if(!num.test(value)){
                return 'Sólo se permiten números enteros';
            }
            if(value*1 < 0){
                return 'Sólo se permiten números enteros positivos';
            }
        }

        /**
         * Valida decimales positivos
         */
        var validaDecimalPositivo = function(value){
            var num=/^-?[0-9.]+$/;
            if(!num.test(value)){
                return 'Sólo se permiten números';
            }
            if(value*1 < 0){
                return 'Sólo se permiten números positivos';
            }
        }

        /**
         * Valida números enteros positivos
         */
        var validaPorcentajePositivo = function(value){
            var num=/^-?[0-9]+$/;
            if(!num.test(value)){
                return 'Sólo se permiten números enteros';
            }
            if(value*1 < 0){
                return 'Sólo se permiten números enteros positivos';
            }
            if(value > 100){
                return 'No puede ser mayor al 100 %'
            }
        }

        /**
         * Con cada movimiento de agregar o borrar un bloque de construccion hay que recalcular los indices
         */
        var recalculaIndices = function(){
            var c = 0;
            $('tr.bloque-construccion > td.bloque-id').each(function(){
                c++;
                $(this).text(c);
            });
        }

        $(function () {

            //Selectores autocompletables
            $(".select2").select2({
                language: "es",
                placeholder: "-- Seleccione",
                allowClear: true,
                dropdownAutoWidth: true,
                width: 'resolve'
            });

            $(".select2-multiple").select2({
                language: "es",
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

            // X-editable

            $.fn.editable.defaults.mode = 'inline';
            $.fn.editable.defaults.emptytext = 'Editar';

            setEditables = function() {
                $('.xeditable').editable({success: actualiza});

                $('.supConstruccion').editable({
                    validate: function (value) {
                        var re = /^-?[0-9.]+$/;
                        if (!re.test(value)) {
                            return 'Sólo se permiten números';
                        }
                    }
                });

                $('.xselect.techos').editable({
                    source: techos,
                    success: actualiza
                });
                $('.xselect.tiposConstruccion').editable({
                    source: tiposConstruccion,
                    display: function (value, sourceData) {
                        var sel = $.fn.editableutils.itemsByValue(value, sourceData);
                        console.log(sel);
                        if (sel[0]) {
                            $(this).html(sel[0].value + ': ' + sel[0].text);
                        } else {
                            $(this).html(null);
                        }
                    },
                    success: actualiza
                });
                $('.xselect.pisos').editable({
                    source: pisos,
                    success: actualiza
                });
                $('.xselect.muros').editable({
                    source: muros,
                    success: actualiza
                });
                $('.xselect.ventanas').editable({
                    source: ventanas,
                    success: actualiza
                });
                $('.xselect.puertas').editable({
                    source: puertas,
                    success: actualiza
                });
                $('.xselect.electricas').editable({
                    source: electricas,
                    success: actualiza
                });
                $('.xselect.hidraulicas').editable({
                    source: hidraulicas,
                    success: actualiza
                });
                $('.xselect.sanitarias').editable({
                    source: sanitarias,
                    success: actualiza
                });
                $('.xselect.instEspeciales').editable({
                    source: instEspeciales,
                    success: actualiza
                });

                $('.antiguedad').editable({
                    validate: validaEnteroPositivo
                });

                $('.xselect.usosConstruccion').editable({
                    source: usosConstruccion,
                    success: actualiza
                });

                $('.avance').editable({
                    validate: validaPorcentajePositivo
                });

                $('.xselect.edosConstruccion').editable({
                    source: edosConstruccion,
                    success: actualiza
                });

                $('.niveles').editable({
                    validate: validaPorcentajePositivo
                });

                //Trata de abrir el siguiente editable
                $('.editable').on('hidden', function(e, reason){
                    if(reason === 'save' || reason === 'nochange' || reason === 'cancel') {
                        var $next = $(this).closest('td').next().find('.editable');
                        setTimeout(function() {
                            $next.editable('show');
                        }, 300);
                    }
                });

                //Boton borrar construccion, si solo queda un registro en la tabla no lo elimina sino que lo limpia.
                $('.borrar-construccion').click(function(ev){
                    ev.preventDefault();
                    var pk = $(this).data('pk');
                    var bloques = $('.bloque-construccion').length;
                    if(bloques == 1)
                    {
                        //console.log($("a.editable[data-pk="+pk+"]"));
                        $("a.editable[data-pk="+pk+"]").editable('setValue', null);
                    }
                    else{
                        $("tr[data-pk="+pk+"]").remove();
                    }
                    $('#datos-construccion').trigger('bloque-borrado',[pk]);
                    return false;
                });
            }

            //Boton agregar bloque de construccion
            $('.agregar-construccion').click(function(ev){
                ev.preventDefault();
                console.log("Agregamos construccion");
                //Tomamos la primera fila editable y la clonamos
                randomID = Math.floor(Math.random()*1000001);
                var trs = $('tr.bloque-construccion');
                var tr = $(trs[0]).clone();
                //var col = "<tr><td colspan='3'><a href='#' data-pk='"+randomID+"'>Mike</a></td></tr>"
                $(tr).attr('data-pk',randomID);
                $(tr).find('a').text(null);
                $(tr).find('a').attr('data-pk', randomID);
                $(tr).find('button').attr('data-pk', randomID);
                $('tbody').append(tr);
                setEditables();
                $('#datos-construccion').trigger('bloque-agregado',[randomID]);
                return false;
            });

            //Se carga el seteo de editables por default
            setEditables();

            $('#datos-construccion').on('bloque-agregado',function(ev, id){
                recalculaIndices();
            })
            $('#datos-construccion').on('bloque-borrado',function(ev, id){
                recalculaIndices();
                delete registrosConstrucciones[id];
            })

            //ToDo: Se debe ver que al clonar un nuevo registro no esté abierto ningun editable.
            //ToDo: Se debe ver como mandar al servidor el objeto generado
            //ToDo: Se debe ver como regenerar la tabla apartir de datos del servidor.
        });
    </script>
@stop
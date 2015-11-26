@extends('layouts.hooktramite')

<!--
Se toma parte del archivo /ofvirtual/notario/manifestacion/_form.blade elaborado por Edgar Orozco
-->
            {{ Form::open(array('url' => 'tramites/inspeccion/solicitud/store', 'method' => 'POST', 'id' => 'forminspecciones')) }}

@section('content')



    <fieldset><legend>Propietario</legend>
        @include('tramites.inspeccion._form_persona_inline',['instancia'=>'enajenante'])
        <h4>Domicilio:</h4>
        @include('tramites.inspeccion._form_persona_domicilio',['instancia'=>'domicilioEnajenante'])
    </fieldset>
    <fieldset><legend>Copropietario</legend>
        {{FORM::copropietario('copropietario')}}
    </fieldset>
    <fieldset><legend>Datos del predio</legend>
	    @include('tramites.inspeccion._form_datos_predio',['instancia'=>'manifestacion'])
	</fieldset>

	<fieldset><legend>Datos de la construcción</legend>
	    @include('tramites.inspeccion._form_datos_construccion_create',['instancia'=>'manifestacion'])
	</fieldset>
    {{ Form::submit('Crear Solicitud de Inspeccion', array('class' => 'btn btn-primary')) }}
{{Form::close()}}
@stop

@section('javascript')

    {{ HTML::script('js/macros/copropietario.js') }}
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
        var registrosConstrucciones = {construcciones:{},sup_albercas:0,sup_total:0};

        var actualiza = function(response, valor){
            var pk = $(this).data('pk');
            var nombre = $(this).data('name');

            //console.log("En el campo %s de la fila %s se puso este nuevo valor %s", nombre, pk, valor);
            if(nombre !== 'sup_albercas') {
                if (pk in registrosConstrucciones.construcciones) {
                    var registro = registrosConstrucciones.construcciones[pk];
                    eval('registro.' + nombre + ' = valor');
                }
                else {
                    var registro = {};
                    eval('registro.' + nombre + ' = valor');
                    registrosConstrucciones.construcciones[pk] = registro;
                }
            }
            else
            {
                registrosConstrucciones.sup_albercas = valor;
            }

            $('#construcciones').val(JSON.stringify(registrosConstrucciones));
            console.log(JSON.stringify(registrosConstrucciones));

        }

        /**
         * Valida números enteros positivos
         */
        var validaEnteroPositivo = function(value){
            var num=/^-?[0-9]+$/;
            if(value) {
                if (!num.test(value)) {
                    return 'Sólo se permiten números enteros';
                }
                if (value * 1 < 0) {
                    return 'Sólo se permiten números enteros positivos';
                }
            }
        }

        /**
         * Valida decimales positivos
         */
        var validaDecimalPositivo = function(value){
            var num=/^\d+\.?\d*$/;
            if(value) {
                if (value * 1 < 0) {
                    return 'Sólo se permiten números positivos';
                }
                if (!num.test(value)) {
                    return 'Sólo se permiten números con decimal opcional';
                }
            }
        }

        /**
         * Valida números enteros positivos
         */
        var validaPorcentajePositivo = function(value){
            var num=/^-?[0-9]+$/;
            if(value) {
                if (!num.test(value)) {
                    return 'Sólo se permiten números enteros';
                }
                if (value * 1 < 0) {
                    return 'Sólo se permiten números enteros positivos';
                }
                if (value > 100) {
                    return 'No puede ser mayor al 100 %'
                }
            }
        }

        /**
         * Con cada movimiento de agregar o borrar un bloque de construccion hay que recalcular los indices
         */
        var recalculaIndices = function(){
            var c = 0;
            var totBloques = $('tr.bloque-construccion > td.bloque-id').length;
            $('.tot-bloques').text(totBloques);
            $('tr.bloque-construccion > td.bloque-id').each(function(){
                c++;
                $(this).text(c);
            });

        }


        var soloRusticos = function(val){
            if(val == 'R' || val == 'r'){
                console.log('rusticos');
                $('.solo-rusticos').show();
            }
            else{
                console.log('otra cosa');
                $('.solo-rusticos').hide();
            }
        }


        $(function () {

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

            $('.tipo-predio').on('blur',function(){
                console.log('dispara blr');
                soloRusticos($(this).val());
            });
            $('.tipo-predio').on('change',function(){
                console.log('dispara chg');
                soloRusticos($(this).val());;
            });

            //Clicks de tipo de persona
            $('.radio-persona').click(function(){
                var radio = $(this);
                var instancia = radio.data('instancia');
                var tipo = radio.val();
               // setTipoPersona(instancia, tipo);
            });


            // X-editable

            $.fn.editable.defaults.mode = 'inline';
            $.fn.editable.defaults.emptytext = 'Editar';
            $.fn.editable.defaults.showbuttons = false;

            //Cuando metemos un nuevo valor y damos aceptar o cerramos se ejecuta la funcion actualizar
            //La funcion actualizar se encarga de almacenar los valores en un objeto regitrosConstrucciones en memoria.
            $.fn.editable.defaults.success = actualiza;

            setEditables = function() {

                $( "tbody > tr:last" ).find('.supConstruccion').editable({
                    validate: validaDecimalPositivo
                });

                $( "tbody > tr:last" ).find('.xselect.techos').editable({
                    source: techos
                });
                $( "tbody > tr:last" ).find('.xselect.tiposConstruccion').editable({
                    source: tiposConstruccion,
                    display: function (value, sourceData) {
                        var sel = $.fn.editableutils.itemsByValue(value, sourceData);
                        if (sel[0]) {
                            $(this).html(sel[0].value + ': ' + sel[0].text);
                        } else {
                            $(this).html(null);
                        }
                    }
                });
                $( "tbody > tr:last" ).find('.xselect.pisos').editable({
                    source: pisos
                });
                $( "tbody > tr:last" ).find('.xselect.muros').editable({
                    source: muros
                });
                $( "tbody > tr:last" ).find('.xselect.ventanas').editable({
                    source: ventanas
                });
                $( "tbody > tr:last" ).find('.xselect.puertas').editable({
                    source: puertas
                });
                $( "tbody > tr:last" ).find('.xselect.electricas').editable({
                    source: electricas
                });
                $( "tbody > tr:last" ).find('.xselect.hidraulicas').editable({
                    source: hidraulicas
                });
                $( "tbody > tr:last" ).find('.xselect.sanitarias').editable({
                    source: sanitarias
                });
                $( "tbody > tr:last" ).find('.xselect.instEspeciales').editable({
                    source: instEspeciales
                });
                $( "tbody > tr:last" ).find('.antiguedad').editable({
                    validate: validaEnteroPositivo
                });
                $( "tbody > tr:last" ).find('.xselect.usosConstruccion').editable({
                    source: usosConstruccion
                });
                $( "tbody > tr:last" ).find('.avance').editable({
                    validate: validaPorcentajePositivo
                });
                $( "tbody > tr:last" ).find('.xselect.edosConstruccion').editable({
                    source: edosConstruccion
                });
                $( "tbody > tr:last" ).find('.niveles').editable({
                    validate: validaEnteroPositivo
                });

                //Trata de abrir el siguiente editable
                $( "tbody > tr:last" ).find('.editable').on('hidden', function(e, reason){
                    if(reason === 'save' || reason === 'nochange' || reason === 'cancel') {
                        var $next = $(this).closest('td').next().find('.editable');
                        //console.log($next);
                        if($next.length) {
                            setTimeout(function () {
                                $next.editable('show');
                            }, 300);
                        }
                        else{
                            //Si ya no hay mas editables entonces movemos el foco al boton de agregar bloque de construccion
                            $('.agregar-construccion').focus();
                        }
                    }
                });

                //Cuando se cierra un editable de superficie se ejecuta actualizacion de total de superficie
                $( "tbody > tr:last" ).find('.supConstruccion').on('hidden', function(e, reason){
                    recalculaTotalSupCons();
                });

                $( ".sup-albercas" ).on('hidden', function(e, reason){
                    recalculaTotalSupCons();
                });

                //Boton borrar construccion, si solo queda un registro en la tabla no lo elimina sino que lo limpia.
                $( "tbody > tr:last" ).find('.borrar-construccion').click(function(ev){
                    ev.preventDefault();
                    var pk = $(this).data('pk');
                    var bloque_id = $(this).closest('tr').find('.bloque-id').text();
                    var bloques = $('.bloque-construccion').length;
                    if(!confirm('Ha presionado el botón para eliminar el Bloque de construcción: "'+bloque_id+ '". ¿Desea continuar con esta acción?')) return false;
                    if(bloques == 1)
                    {
                        $("a.editable[data-pk="+pk+"]").editable('setValue', null);
                    }
                    else{
                        $("tr[data-pk="+pk+"]").remove();
                    }
                    $('#datos-construccion').trigger('bloque-borrado',[pk]);
                    return false;
                });
            }

            //Editable de la superficie de albercas
            $('.sup-albercas').editable({
                validate: validaDecimalPositivo
            });


            //Boton agregar bloque de construccion
            $('.agregar-construccion').click(function(ev){
                ev.preventDefault();

                //Primero cerramos todos los posibles editables abiertos para no clonar inputs abiertos
                $('.editable').editable('hide');

                //Tomamos la primera fila editable y la clonamos
                randomID = Math.floor(Math.random()*1000001);
                var trs = $('tr.bloque-construccion');
                var tr = $(trs[0]).clone();
                //var col = "<tr><td colspan='3'><a href='#' data-pk='"+randomID+"'>Mike</a></td></tr>"
                $(tr).attr('data-pk',randomID);
                $(tr).find('.bloque-id').text(null);
                $(tr).find('a').text(null);
                $(tr).find('a').attr('data-pk', randomID);
                $(tr).find('button').attr('data-pk', randomID);
                $('tbody').append(tr);
                $('#datos-construccion').trigger('bloque-agregado',[randomID]);
                return false;
            });

            //Escucha los eventos de agregar un nuevo bloque de construccion
            $('#datos-construccion').on('bloque-agregado',function(ev, id){
                setEditables();
                //Recalcula los indices y renumera toda la primera columna
                recalculaIndices();
                //ToDo: Aqui debe haber un coso que calcule los totales de superficie y de bloques
                //Recalcula totales
                recalculaTotalSupCons();

                //Aquí abre el primer editable del nuevo row
                $( "tbody > tr:last" ).find('a:first').click();
            })

            //Escucha los eventos de eliminar un bloque de construccion
            $('#datos-construccion').on('bloque-borrado',function(ev, id){
                //Recalcula los indices
                recalculaIndices();
                //Recalcula totales
                recalculaTotalSupCons();

                //Borra del objeto los valores correspondientes a la fila
                delete registrosConstrucciones.construcciones[id];
            })

            //ToDo: Se debe ver como regenerar la tabla apartir de datos del servidor.

            //Se carga el seteo de editables por default
            setEditables();
        });

        var recalculaTotalSupCons = function(){
            var sup_total = 0;
            for(i in registrosConstrucciones.construcciones){
                if(i !== 'sup_albercas') {
                    sup_total += Number(registrosConstrucciones.construcciones[i].sup_construccion);
                    //console.log("La sup total calculada en el %s : %s",i, sup_total);
                }
            }
            sup_total += Number(registrosConstrucciones.sup_albercas);
            $('#total-sup-cons').text(sup_total);
            registrosConstrucciones.sup_total = sup_total;
            //console.log(sup_total);
        }

        //autocompleter para la curp de los copropietarios
        $('body').on('keyup','.curp',function () {

             //Estas son las opciones con las que se construye el autocomplete, como son comunes a los dos inputs rfc y curp se sacan para reutlizar
            var autoCompleteOptsAdquiriente = {
                source: "/ofvirtual/notario/registro/adquiriente", //Ruta al controlador que provee los resultados de la busqueda
                minLength: 5, //Empezamos a mandar los teclazos si han tecleado 8 caracteres
                select: function (event, ui) {
                    //Al seleccionar un valor de los desplegados rellenamos los campos

                var rfc = 'copropietario[0][rfc]';
                var nombres = 'copropietario[0][nombres]';
                var apellido_paterno = 'copropietario[0][apellido_paterno]';
                var apellido_materno = 'copropietario[0][apellido_materno]';

                var num = parseInt($(this).prop("name").match(/\d+/g), 10) ;

                rfc = rfc.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
                nombres = nombres.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
                apellido_paterno = apellido_paterno.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
                apellido_materno = apellido_materno.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
                console.log('rfc '+ rfc);

                $('#' +  $(this).attr('name').replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.curp);
                $('#' +  rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.rfc);
                $('#' +  nombres.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.nombres);
                $('#' +  apellido_paterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.apellido_paterno);
                $('#' +  apellido_materno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.apellido_materno);
                    return false;
                }
            };
            //Se crea autocompleter de CURP
            $('#' +  $(this).attr('name').replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete(autoCompleteOptsAdquiriente).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.curp + "<br>" + "<span class='nombre-coincidencia'><i class='glyphicon glyphicon-user'></i><small> " + item.nombrec + "</small><span></a>")
                        .appendTo(ul);
            };
});

 //autocompleter para la curp de los copropietarios
        $('body').on('keyup','.rfc',function () {
             //alert('rfc');
             //Estas son las opciones con las que se construye el autocomplete, como son comunes a los dos inputs rfc y curp se sacan para reutlizar
            var autoCompleteOptsAdquiriente = {
                source: "/ofvirtual/notario/registro/adquiriente", //Ruta al controlador que provee los resultados de la busqueda
                minLength: 5, //Empezamos a mandar los teclazos si han tecleado 8 caracteres
                select: function (event, ui) {
                    //Al seleccionar un valor de los desplegados rellenamos los campos

                var rfc = 'copropietario[0][rfc]';
                var nombres = 'copropietario[0][nombres]';


                var num = parseInt($(this).prop("name").match(/\d+/g), 10) ;

                rfc = rfc.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");
                nombres = nombres.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");

                console.log('rfc '+ rfc);


                $('#' +  rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.rfc);
                $('#' +  nombres.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.nombres);

                    return false;
                }
            };
            //Se crea autocompleter de CURP
            $('#' +  $(this).attr('name').replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete(autoCompleteOptsAdquiriente).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.curp + "<br>" + "<span class='nombre-coincidencia'><i class='glyphicon glyphicon-user'></i><small> " + item.nombrec + "</small><span></a>")
                        .appendTo(ul);
            };
});




    </script>
@stop
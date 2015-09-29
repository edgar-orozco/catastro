<div class="row">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" id="tab-valuar-terreno"><a href="#datos-valuar-terreno" aria-controls="datos-valuar-terreno" role="tab" data-toggle="tab">Datos para valuar terreno</a></li>
        <li role="presentation" class="" id="tab-valuar-construccion"><a href="#datos-valuar-construccion" aria-controls="datos-valuar-construccion" role="tab" data-toggle="tab">Datos para valuar construcción</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="datos-valuar-terreno">
            @include('tramites.valor._form_valuar_terreno', [] )
        </div>
        <div role="tabpanel" class="tab-pane" id="datos-valuar-construccion">
            @include('tramites.valor._form_valuar_construccion', [] )
        </div>
    </div>

</div>

<div class="row">
    @include('tramites.valor._form_control', [] )
</div>


@section('javascript')

    {{ HTML::script('js/select2/select2.full.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}
    {{ HTML::style('css/select2.min.css') }}

    {{ HTML::script('js/jquery/jquery-ui-autocomplete.min.js') }}
    {{ HTML::style('js/jquery/jquery-ui.css') }}
    {{ HTML::script('js/jquery/jquery.mask.min.js') }}

    {{-- X-Editable--}}
    {{ HTML::script('js/bootstrap-editable.min.js') }}
    {{ HTML::style('css/bootstrap-editable.css') }}

    {{-- Js de las reglas de negocio --}}
    {{ HTML::script('js/tramites/valor.js') }}

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


        $(function () {

            //Selectores autocompletables
            $(".select2").select2({
                language: "es",
                placeholder: "-- Seleccione",
                allowClear: true,
                dropdownAutoWidth: true,
                width: 'resolve'
            });

            // X-editable

            $.fn.editable.defaults.mode = 'inline';
            $.fn.editable.defaults.emptytext = 'Editar';

            //Cuando metemos un nuevo valor y damos aceptar o cerramos se ejecuta la funcion actualizar
            //La funcion actualizar se encarga de almacenar los valores en un objeto regitrosConstrucciones en memoria.
            $.fn.editable.defaults.success = actualiza;

            setEditables = function() {

                $( "tbody.tcons > tr:last" ).find('.supConstruccion').editable({
                    validate: validaDecimalPositivo
                });

                $( "tbody.tcons > tr:last" ).find('.xselect.techos').editable({
                    source: techos
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.tiposConstruccion').editable({
                    source: tiposConstruccion,
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.pisos').editable({
                    source: pisos
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.muros').editable({
                    source: muros
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.ventanas').editable({
                    source: ventanas
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.puertas').editable({
                    source: puertas
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.electricas').editable({
                    source: electricas
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.hidraulicas').editable({
                    source: hidraulicas
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.sanitarias').editable({
                    source: sanitarias
                });
                $( "tbody.tcons > tr:last" ).find('.antiguedad').editable({
                    validate: validaEnteroPositivo
                });
                $( "tbody.tcons > tr:last" ).find('.avance').editable({
                    validate: validaPorcentajePositivo
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.edosConstruccion').editable({
                    source: edosConstruccion
                });
                $( "tbody.tcons > tr:last" ).find('.niveles').editable({
                    validate: validaEnteroPositivo
                });

                //Trata de abrir el siguiente editable
                $( "tbody.tcons > tr:last" ).find('.editable').on('hidden', function(e, reason){
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
                $( "tbody.tcons > tr:last" ).find('.supConstruccion').on('hidden', function(e, reason){
                    recalculaTotalSupCons();
                });

                $( ".sup-albercas" ).on('hidden', function(e, reason){
                    recalculaTotalSupCons();
                });

                //Boton borrar construccion, si solo queda un registro en la tabla no lo elimina sino que lo limpia.
                $( "tbody.tcons > tr:last" ).find('.borrar-construccion').click(function(ev){
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
                $('tbody.tcons').append(tr);
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
                $( "tbody.tcons > tr:last" ).find('a:first').click();
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

            //Cuando el uso de suelo es baldío (id == 1) quiere decir que no hay tab de construcciones
            $(".select-usosuelo_id").on('change', function(){
                console.log("ccaca %s",$(this).val());
                if($(this).val() == 1){
                    $('#tab-valuar-construccion').hide();
                }
                else {
                    $('#tab-valuar-construccion').show();
                }
            });


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

    </script>
@stop
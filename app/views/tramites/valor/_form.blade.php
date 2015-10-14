<div class="row">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" id="tab-valuar-terreno"><a href="#datos-valuar-terreno" aria-controls="datos-valuar-terreno" role="tab" data-toggle="tab">Datos para valuar terreno</a></li>
        <li role="presentation" class="" id="tab-valuar-construccion"><a href="#datos-valuar-construccion" aria-controls="datos-valuar-construccion" role="tab" data-toggle="tab">Datos para valuar construcción</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="datos-valuar-terreno">
            <br/>
            @if($tipo_predio == 'U')
                @include('tramites.valor._form_valuar_terreno', [] )
            @else
                @include('tramites.valor._form_valuar_terreno_rustico', [] )
            @endif
        </div>
        <div role="tabpanel" class="tab-pane" id="datos-valuar-construccion">
            <br/>
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
    {{ HTML::script('js/highcharts/highcharts.js') }}

    {{-- X-Editable--}}
    {{ HTML::script('js/bootstrap-editable.min.js') }}
    {{ HTML::style('css/bootstrap-editable.css') }}

    {{-- Js de las reglas de negocio --}}
    {{ HTML::script('js/tramites/valor.js') }}

    <script>
        //Fuentes de datos para selects del xeditable
        var municipio = '{{$municipio}}';
        var categorias ={{json_encode((array)$categoriasConstruccion)}};
        var valoresConstruccion ={{json_encode($valoresConstruccion)}};

        var edosConstruccion = {{json_encode((array)$edosConstruccion)}};
        var tiposConstruccion = {{json_encode((array)$tiposConstruccion)}};
        var tipoTerreno = '{{$tipo_predio}}'; //Tipo de predio rústico o urbano
        var elementosConstruccion = {{json_encode((array)$elementosConstruccion)}};
        var anioActual = {{date("Y")}};
        var setEditables = null;
        var tiposAlbercas = {{json_encode($tiposAlbercas)}};
        var valoresAlbercas = {{json_encode($valoresAlbercas)}};

        var registrosConstrucciones = {construcciones:{},sup_total:0, construccionesAlbercas:{}, sup_cons:0, sup_albercas:0};

        var valorXElemento = function(municipio, tipo_construccion, categoria, elemento, conservacion){
            var v;
            var elementoID = elementosConstruccion[elemento];
            v = valoresConstruccion[municipio][tipo_construccion][categoria][elementoID][conservacion];
            return v;
        }

        var valuaBloqueConstruccion = function(pk,municipio){

            //Se calcula mediante la moda el valor de los 16 tipos, es decir la clase predominante
            var predominante = [];

            var techos, muros, pisos, puertas, hidraulicas, electricas, sanitarias;

            for(elem in registrosConstrucciones.construcciones[pk]){
                if(elem == 'sup_construccion') sup_construccion = registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'tipo_construccion') tipo_construccion = registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'techos') techos = registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'muros') muros= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'pisos') pisos= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'puertas') puertas= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'hidraulicas') hidraulicas= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'electricas') electricas= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'sanitarias') sanitarias= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'antiguedad') antiguedad= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'edo_construccion') edo_construccion= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'avance') avance= registrosConstrucciones.construcciones[pk][elem];
                else if(elem == 'num_niveles') num_niveles= registrosConstrucciones.construcciones[pk][elem];
            }

            //Inicializamos a cero todos los valores de bloques
            predominante[techos] = predominante[muros] = predominante[pisos] = predominante[puertas] = predominante[hidraulicas] = predominante[electricas] =  predominante[sanitarias] = 0;
            predominante[techos]++;
            predominante[muros]++;
            predominante[pisos]++;
            predominante[puertas]++;
            predominante[hidraulicas]++;
            predominante[electricas]++;
            predominante[sanitarias]++;

            var categos = limitaCategorias(pk);
            var predom = Object.keys(predominante).reduce(function(a, b){ return predominante[a] > predominante[b] ? a : b });
            console.log("predominante %s %s", predom, categos[predom]);

            //Basta con calcular la categoria de un solo elemento si es la categoria predominante. Escogemos techos (ninguna razón en particular, podria ser cualquiera)
            var valCategoria = valorXElemento(municipio, tipo_construccion, predom, 'techos', edo_construccion);

            //Se calcula el valor del bloque de construccion (valor categoria / m2 x superficie de construccion)
            var valBloque = valCategoria * sup_construccion;

            //Aqui insertamos en las nuevas columnas categoria y valor/m2 para que sean visibles en la tabla
            //Todo: Hacerlo en otro lado y de otra forma
            $('.bloque-construccion[data-pk='+pk+'] td.categoria').text(categos[predom]);
            $('.bloque-construccion[data-pk='+pk+'] td.val-categoria').text(valCategoria);

            return valBloque;
        }

        var valuaBloqueConstruccionAlberca= function(pk){
            var tipo = registrosConstrucciones.construccionesAlbercas[pk]['tipoalberca'];
            var superficie = registrosConstrucciones.construccionesAlbercas[pk]['superficie_alberca'];
            var valorUnitario = valoresAlbercas[tipo];
            var valor = superficie * valorUnitario;
            //ToDo: Hacer esto en otro lado y de otra forma
            $('.bloque-alberca[data-pk='+pk+'] td.val-categoria-albercas').text(valorUnitario);
            console.log("ValorAlberca %s Tipo %s Sup %s valorUnitario %s valor: ",pk,tipo,superficie, valorUnitario, valor);
            return valor;
        }

        var demBloquesConstruccion = function(pk){
            var dem = 0;
            try {
                var anioCons = registrosConstrucciones.construcciones[pk].antiguedad;
                var pctTerm = registrosConstrucciones.construcciones[pk].avance;
                var demEdad = demConstruccionEdad(anioCons, anioActual);
                var demTerminado = demConstruccionTerminado(pctTerm);
                dem = demEdad + demTerminado;
                console.log("BloqueCons %s Dm Edad: %s Dm Term: %s DemTot: %s", pk, demEdad, demTerminado, dem);
            }catch(e){
                console.log("No hay bloques de construcción que valuar")
            }
            return dem;
        }

        var demBloquesConstruccionAlbercas = function(pk){
            var dem = 0;
            try {
                var anioCons = registrosConstrucciones.construccionesAlbercas[pk].antiguedad;
                var pctTerm = registrosConstrucciones.construccionesAlbercas[pk].avance;
                var demEdad = demConstruccionEdad(anioCons, anioActual);
                var demTerminado = demConstruccionTerminado(pctTerm);
                dem = demEdad + demTerminado;
                console.log("BloqueCons Alberca %s Dm Edad: %s Dm Term: %s DemTot: %s", pk, demEdad, demTerminado, dem);
            }catch(e){
                console.log("No hay bloques de construccion de albercas que valuar");
            }
            return dem;
        }

        var actualiza = function(response, valor){
            var tipoBloque = $(this).closest('tbody').attr('class');
            var pk = $(this).data('pk');
            var nombre = $(this).data('name');
            if(tipoBloque == 'tcons') {
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
            else if(tipoBloque == 'talbercas'){
                if (pk in registrosConstrucciones.construccionesAlbercas) {
                    var registro = registrosConstrucciones.construccionesAlbercas[pk];
                    eval('registro.' + nombre + ' = valor');
                }
                else {
                    var registro = {};
                    eval('registro.' + nombre + ' = valor');
                    registrosConstrucciones.construccionesAlbercas[pk] = registro;
                }
            }

            $('#construcciones').val(JSON.stringify(registrosConstrucciones));
            //console.log(JSON.stringify(registrosConstrucciones));

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

        var recalculaIndicesAlbercas = function(){
            var c = 0;
            var totBloques = $('tr.bloque-alberca > td.alberca-id').length;
            $('.tot-bloques').text(totBloques);
            $('tr.bloque-alberca > td.alberca-id').each(function(){
                c++;
                $(this).text(c);
            });

        }


        var fnCategorias = function(){
            var pk = $(this).data('pk');
            return limitaCategorias(pk);
        }

        var limitaCategorias = function(pk){
            var tipoConstruccion = registrosConstrucciones.construcciones[pk].tipo_construccion;
            return categorias[tipoConstruccion];
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
            $.fn.editable.defaults.showbuttons = false;
            //$.fn.editable.defaults.onblur = 'submit';

            //Cuando metemos un nuevo valor y damos aceptar o cerramos se ejecuta la funcion actualizar
            //La funcion actualizar se encarga de almacenar los valores en un objeto regitrosConstrucciones en memoria.
            $.fn.editable.defaults.success = actualiza;

            setEditables = function() {

                $( "tbody.tcons > tr:last" ).find('.supConstruccion').editable({
                    validate: validaDecimalPositivo
                });

                $( "tbody.tcons > tr:last" ).find('.xselect.tiposConstruccion').editable({
                    source: tiposConstruccion
                });

                $( "tbody.tcons > tr:last" ).find('.xselect.techos').editable({
                    source: fnCategorias
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.pisos').editable({
                    source: fnCategorias
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.muros').editable({
                    source: fnCategorias
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.puertas').editable({
                    source: fnCategorias
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.electricas').editable({
                    source: fnCategorias
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.hidraulicas').editable({
                    source: fnCategorias
                });
                $( "tbody.tcons > tr:last" ).find('.xselect.sanitarias').editable({
                    source: fnCategorias
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
                    //console.log(e);
                    if(reason === 'save' || reason === 'nochange' || reason === 'cancel') {
                        var $next = $(this).closest('td').next().find('.editable');
                        //console.log($next);
                        if($next.length) {
                            setTimeout(function () {
                                $next.editable('show');
                            }, 100);
                        }
                        else{
                            //Si ya no hay mas editables entonces movemos el foco al boton de agregar bloque de construccion
                            $('.agregar-construccion').focus();
                        }
                    }
                }); //Editable on hidden

                //Cuando se cierra un editable de superficie se ejecuta actualizacion de total de superficie
                $( "tbody.tcons > tr:last" ).find('.supConstruccion').on('hidden', function(e, reason){
                    recalculaTotalSupCons();
                });

                //Boton borrar construccion, si solo queda un registro en la tabla no lo elimina sino que lo limpia.
                $( "tbody.tcons > tr:last > td:last > button" ).on('click',function(ev){
                    ev.preventDefault();
                    var pk = $(this).data('pk');
                    var bloque_id = $(this).closest('tr').find('.bloque-id').text();
                    var bloques = $('.bloque-construccion').length;
                    if(!confirm('Ha presionado el botón para eliminar el Bloque de construcción: "'+bloque_id+ '". ¿Desea continuar con esta acción?')) return false;
                    if(bloques == 1)
                    {
                        $(".tcons a.editable[data-pk="+pk+"]").editable('setValue', null);
                        $("tr.bloque-construccion[data-pk="+pk+"] td.categoria").text(null);
                        $("tr.bloque-construccion[data-pk="+pk+"] td.val-categoria").text(null);
                    }
                    else{
                        $("tr.bloque-construccion[data-pk="+pk+"]").remove();
                    }
                    $('#datos-construccion').trigger('bloque-borrado',[pk]);
                    return false;
                });


            } //setEditables


            setEditablesAlbercas = function() {
                $( "tbody.talbercas > tr:last" ).find('.tipoAlberca').editable({
                    source: tiposAlbercas
                });
                $( "tbody.talbercas > tr:last" ).find('.superficieAlberca').editable({
                    validate: validaDecimalPositivo
                });
                $( "tbody.talbercas > tr:last" ).find('.antiguedad').editable({
                    validate: validaEnteroPositivo
                });
                $( "tbody.talbercas > tr:last" ).find('.avance').editable({
                    validate: validaPorcentajePositivo
                });

                //Boton borrar albercas, si solo queda un registro en la tabla no lo elimina sino que lo limpia.
                $( "tbody.talbercas > tr:last > td:last > button" ).on('click',function(ev){
                    ev.preventDefault();
                    var pk = $(this).data('pk');
                    var alberca_id = $(this).closest('tr').find('.alberca-id').text();
                    var albercas = $('.bloque-alberca').length;
                    if(!confirm('Ha presionado el botón para eliminar la alberca: "'+alberca_id+ '". ¿Desea continuar con esta acción?')) return false;
                    if(albercas == 1)
                    {
                        $(".talbercas a.editable[data-pk="+pk+"]").editable('setValue', null);
                        $("tr.bloque-alberca[data-pk="+pk+"] td.val-categoria-albercas").text(null);
                    }
                    else{
                        $("tr.bloque-alberca[data-pk="+pk+"]").remove();
                    }
                    $('#datos-albercas').trigger('alberca-borrada',[pk]);
                    return false;
                });

                //Trata de abrir el siguiente editable
                $( "tbody.talbercas > tr:last" ).find('.editable').on('hidden', function(e, reason){
                    //console.log(e);
                    if(reason === 'save' || reason === 'nochange' || reason === 'cancel') {
                        var $next = $(this).closest('td').next().find('.editable');
                        //console.log($next);
                        if($next.length) {
                            setTimeout(function () {
                                $next.editable('show');
                            }, 100);
                        }
                        else{
                            //Si ya no hay mas editables entonces movemos el foco al boton de agregar bloque de construccion
                            $('.agregar-alberca').focus();
                        }
                    }
                }); //Editable on hidden

                //Cuando se cierra un editable de superficie se ejecuta actualizacion de total de superficie
                $( "tbody.talbercas > tr:last" ).find('.superficieAlberca').on('hidden', function(e, reason){
                    console.log("se recalcula sup cons");
                    recalculaTotalSupCons();
                });


            } // setEditablesAlbercas



            //Boton agregar bloque de construccion
            $('.agregar-construccion').click(function(ev){
                ev.preventDefault();

                //Primero cerramos todos los posibles editables abiertos para no clonar inputs abiertos
                $('.editable').editable('hide');

                //Tomamos la primera fila editable y la clonamos
                randomID = new Date().getTime();
                var trs = $('tr.bloque-construccion');
                var tr = $(trs[0]).clone();
                $(tr).attr('data-pk',randomID);
                $(tr).find('.bloque-id').text(null);
                $(tr).find('a').text(null);
                $(tr).find('a').attr('data-pk', randomID);
                $(tr).find('button').attr('data-pk', randomID);
                $('tbody.tcons').append(tr);
                $('#datos-construccion').trigger('bloque-agregado',[randomID]);
                return false;
            });

            //Boton agregar alberca
            $('.agregar-alberca').click(function(ev){
                ev.preventDefault();

                //Primero cerramos todos los posibles editables abiertos para no clonar inputs abiertos
                $('.editable').editable('hide');

                //Tomamos la primera fila editable y la clonamos
                randomID = new Date().getTime();
                var trs = $('tr.bloque-alberca');
                var tr = $(trs[0]).clone();
                $(tr).attr('data-pk',randomID);
                $(tr).find('.alberca-id').text(null);
                $(tr).find('a').text(null);
                $(tr).find('a').attr('data-pk', randomID);
                $(tr).find('button').attr('data-pk', randomID);
                $('tbody.talbercas').append(tr);
                $('#datos-albercas').trigger('alberca-agregada',[randomID]);
                return false;
            });

            //Escucha los eventos de agregar un nuevo bloque de construccion
            $('#datos-construccion').on('bloque-agregado',function(ev, id){
                setEditables();
                //Recalcula los indices y renumera toda la primera columna
                recalculaIndices();
                //Recalcula totales
                recalculaTotalSupCons();
                //Aquí abre el primer editable del nuevo row
                $( "tbody.tcons > tr:last" ).find('a:first').click();
            });

            //Escucha los eventos de agregar una nueva alberca
            $('#datos-albercas').on('alberca-agregada',function(ev, id){
                setEditablesAlbercas();
                //Recalcula los indices y renumera toda la primera columna
                recalculaIndicesAlbercas();
                //Recalcula totales
                recalculaTotalSupCons();
                //Aquí abre el primer editable del nuevo row
                $( "tbody.talbercas> tr:last" ).find('a:first').click();
            });

            //Escucha los eventos de eliminar un bloque de construccion
            $('#datos-construccion').on('bloque-borrado',function(ev, id){
                //Recalcula los indices
                recalculaIndices();
                //Borra del objeto los valores correspondientes a la fila
                delete registrosConstrucciones.construcciones[id];
                //Recalcula totales
                recalculaTotalSupCons();
            });

            //Escucha los eventos de eliminar una alberca
            $('#datos-albercas').on('alberca-borrada',function(ev, id){
                //Recalcula los indices
                recalculaIndicesAlbercas();
                //Borra del objeto los valores correspondientes a la fila
                delete registrosConstrucciones.construccionesAlbercas[id];
                //Recalcula totales
                recalculaTotalSupCons();
            });

            //Cuando el uso de suelo es baldío (id == 1) quiere decir que no hay tab de construcciones
            $(".select-usosuelo_id").on('change', function(){
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
            setEditablesAlbercas();

            console.log("Desde adentro %s",$('body').height());
        });

        var recalculaTotalSupCons = function(){
            var sup_total_cons = 0;
            var sup_total_alb = 0;
            var numCons = 0;
            var numAlbercas = 0;

            for(i in registrosConstrucciones.construcciones){
                numCons++;
                sup_total_cons += Number(registrosConstrucciones.construcciones[i].sup_construccion);
            }

            $('#datos-construccion tfoot td.sup-total-construcciones').text(fixed(sup_total_cons));

            for(i in registrosConstrucciones.construccionesAlbercas){
                numAlbercas++;
                sup_total_alb += Number(registrosConstrucciones.construccionesAlbercas[i].superficie_alberca);
            }
            $('#datos-albercas tfoot td.sup-total-albercas').text(fixed(sup_total_alb));


            registrosConstrucciones.sup_total = sup_total_cons + sup_total_alb;
            registrosConstrucciones.sup_albercas = sup_total_alb;
            registrosConstrucciones.sup_cons = sup_total_cons;

            $('#sup-total').text(fixed(sup_total_cons + sup_total_alb));

            numCons = (sup_total_cons) ? numCons : 0;
            numAlbercas = (sup_total_alb) ? numAlbercas : 0;

            $('#total-construcciones').text(numCons + numAlbercas);
            //console.log(sup_total);
        }


    </script>
@stop
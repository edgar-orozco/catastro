{{ Form::open(array('url' => 'ofvirtual/notario/traslado/create', 'method' => 'GET')) }}
<!--<form id="lista-tipotramites">-->
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                        <!-- Inputs de clave o cuenta -->
                         <div class="row col-sm-8">
                            <div>
                                <div class="form-group">

                                   <!-- <div class="input-group">
                                         Select clave o cuenta 
                                        <div class="input-group-btn">
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle select-busqueda"
                                                    data-tipobusqueda="cuenta"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <span class="dropdown-label">Cuenta</span>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu tipo-busqueda" role="menu">
                                                <li><a href="javascript:void(0);" class="opcion-buqueda" data-tipo="cuenta">Cuenta</a>
                                                </li>
                                                <li><a href="javascript:void(0);" class="opcion-busqueda" data-tipo="clave">Clave</a></li>
                                            </ul>
                                        </div>

                                        <!-- Select municipios 
                                        <div class="input-group-btn control-municipios">
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle select-municipio"
                                                    data-municipio=""
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <span class="dropdown-label">
                                                    @if(count($municipios) == 1)
                                                        {{$municipios[0]->nombre_municipio}} - {{$municipios[0]->municipio}}
                                                    @else
                                                    Municipio

                                                    @endif
                                                </span>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu municipio" role="menu">
                                                @foreach($municipios as $municipio)
                                                    <li><a href="javascript:void(0);" class="opcion-municipio"
                                                           data-municipio="{{$municipio->municipio}}">{{$municipio->nombre_municipio}}
                                                            - {{$municipio->municipio}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- //Select municipios 

                                        <!-- Select Urbano o Rustico 
                                        <div class="input-group-btn control-tipopredio">
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle select-tipopredio"
                                                    data-tipopredio="U"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <span class="dropdown-label">Urbano</span>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu tipo-predio" role="menu">
                                                <li><a href="javascript:void(0);" class="opcion-tipopredio" data-tipopredio="R">Rústico</a></li>
                                                <li><a href="javascript:void(0);" class="opcion-tipopredio" data-tipopredio="U">Urbano</a></li>
                                            </ul>
                                        </div> -->
                                        <div class="col-md-12">
                                        {{Form::claveCuenta('registro')}}

                                       
                                        {{Form::hidden('clave', null, ['id'=>'clave'])}}

                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Crear Regisro de Escritura
                                                <span class="glyphicon glyphicon-plus boton-buscador" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                        </div>

                                    </div>


                            <!-- /col-md-6 -->
                            <div>
                                <div class="alert alert-danger" style="display: none;">
                                    No se encontró el predio solicitado en el padrón.
                                </div>
                            </div>
                        <!-- //Inputs de clave o cuenta -->
           </div></div></div>      </div>
<!--</form>-->



{{ Form::close() }}


@section('javascript')
    {{ HTML::script('js/laroute.js') }}
    {{ HTML::script('js/jquery/jquery.mask.min.js') }}
    {{--{{ HTML::script('js/ventanilla/primera-atencion.js') }}--}}
    @if(count($municipios) == 1)
    <script>


    //Función para formatear con ceros a la izquierda
    String.prototype.lpad = function(pad, length) {
        var str = this;
        while (str.length < length)
            str = pad + str;
        return str;
    }


    $(function () {
        //Inicializamos el campo con una máscara por cuenta catastral

        $('.clave-catastral').mask("000000", {
            placeholder: "000000"
        });



        $('.clave-catastral').change(function (ev) {
                 var claveTxt = $(this).val().trim();
                 var tipoBusqueda = $('.select-busqueda').data('tipobusqueda');
                 var municipio = $('.select-municipio').data('municipio');
                 var tipoPredio = $('.select-tipopredio').data('tipopredio');

                 if(tipoBusqueda == 'cuenta') {
                     claveTxt = municipio.substr(1) + "-" + tipoPredio + "-" + claveTxt.lpad("0", 6);

                 }
                  if (clave == '') {
                             return false;
                         }


                 $('#clave').val(claveTxt);
                  //console.log(claveTxt);
         });



    //Cuando se selecciona un valor del dropdown del buscador entonces:
            $('.dropdown-menu.tipo-busqueda li a').click(function () {
                var tipo = $(this).data('tipo');
                $('.select-busqueda').data('tipobusqueda', tipo);
                $('.clave-catastral').val('');
                if (tipo == 'cuenta') {
                    $('.clave-catastral').mask("000000", {
                        placeholder: "000000"
                    });
                    $('.select-busqueda .dropdown-label').text('Cuenta');
                    $('.select-busqueda').data('tipobusqueda','cuenta');
                    $('.control-municipios').show();
                    $('.control-tipopredio').show();

                }
                else {
                    $('.clave-catastral').mask("00-000-000-0000-000000", {placeholder: "__-___-___-____-______"});
                    $('.select-busqueda .dropdown-label').text('Clave');
                    $('.select-busqueda').data('tipobusqueda','clave');
                    $('.control-municipios').hide();
                    $('.control-tipopredio').hide();

                }
        });


         //Cuando se selecciona un valor del dropdown de municipios del buscador entonces:
            $('.dropdown-menu.municipio li a').click(function () {
                var municipio = $(this).data('municipio');
                $('.select-municipio').data('municipio', municipio);
                $('.clave-catastral').val('');
                $('.select-municipio .dropdown-label').text(municipio);
            });

            //Cuando se selecciona un valor del dropdown de tipo de predio entonces:
            $('.dropdown-menu.tipo-predio li a').click(function () {
               // console.log($(this).data('tipopredio'));
                var tipopredio = $(this).data('tipopredio');
                $('.select-tipopredio').data('tipopredio', tipopredio);
                $('.clave-catastral').val('');
                $('.select-tipopredio .dropdown-label').text(tipopredio);
            });

                $(function () {
                    var municipio = "{{$municipios[0]->municipio}}";
                    $('.select-municipio').data('municipio', municipio);
                 });


});




    </script>
    @endif
@append
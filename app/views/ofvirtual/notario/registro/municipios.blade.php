{{ Form::open(array('url' => 'ofvirtual/notario/registro/create', 'method' => 'GET')) }}
                                        <div class="row col-sm-4">


                                            {{Form::claveCuenta()}}
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Crear Regisro de Escritura
                                                <span class="glyphicon glyphicon-plus boton-buscador" aria-hidden="true"></span>
                                            </button>
                                        </span>
                            <div>
                                <div class="alert alert-danger" style="display: none;">
                                    No se encontró el predio solicitado en el padrón.
                                </div>
                            </div>



{{ Form::close() }}


@section('javascript')
    {{ HTML::script('js/laroute.js') }}
    {{ HTML::script('js/jquery/jquery.mask.min.js') }}
    {{--{{ HTML::script('js/ventanilla/primera-atencion.js') }}--}}
    @if(count($municipios) >= 1)
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
                  console.log(claveTxt);
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
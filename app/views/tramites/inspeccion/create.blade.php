@extends('layouts.hooktramite')

<!--
Se toma parte del archivo /ofvirtual/notario/manifestacion/_form.blade elaborado por Edgar Orozco
-->
            {{ Form::open(array('url' => 'tramites/inspeccion/solicitud/store', 'method' => 'POST', 'id' => 'forminspeccion')) }}

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

    {{HTML::script('js/macros/copropietario.js')}}
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



        $('body').on('keyup','.curp',function () {

             //Estas son las opciones con las que se construye el autocomplete, como son comunes a los dos inputs rfc y curp se sacan para reutlizar
            var autoCompleteOptsAdquiriente = {
                source: "/ofvirtual/notario/registro/adquiriente", //Ruta al controlador que provee los resultados de la busqueda
                minLength: 5, //Empezamos a mandar los teclazos si han tecleado 8 caracteres
                select: function (event, ui) {
                    //Al seleccionar un valor de los desplegados rellenamos los campos

                var rfc = 'copropietario[1][rfc]';

                  var num = parseInt($(this).prop("name").match(/\d+/g), 10) ;

                   rfc = rfc.replace(/(\w+)\[(\d+)\]\[(\w+)\]/, "$1[" + num + "][$3]");

            $('#' +  $(this).attr('name').replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.curp);
            $('#' +  rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val(ui.item.rfc);
            //datos domicilio

                    return false;
                }
            };


            //Se crea autocompleter de CURP

            $('#' +  $(this).attr('name').replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete(autoCompleteOptsAdquiriente).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.curp + "<br>" + "<span class='nombre-coincidencia'><i class='glyphicon glyphicon-user'></i><small> " + item.nombrec + "</small><span></a>")
                        .appendTo(ul);
            };
            //Se crea autocompleter de RFC

            //por default es persona física por lo que el autocomplete lo deshabilitamos
            //$('#' + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).autocomplete("disable");
        });


    </script>
@stop
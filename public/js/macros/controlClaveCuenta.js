/**
 * Script para dar funcionalidad al control de clave o cuenta con mask input
 */

$(function () {

    var cuenta = $('.clave-catastral').val();
    var tipo = 'cuenta';
    if(cuenta){
        if(cuenta.length > 11){
            //Se trtata de una clave catastral
            tipo = 'clave';
            tipoControl(tipo);
        }
    }

    tipoControl(tipo);

    //Cuando se selecciona un valor del dropdown del buscador entonces:
    $('.dropdown-menu.tipo-busqueda li a').click(function () {
        var tipo = $(this).data('tipo');
        $('.select-busqueda').data('tipobusqueda', tipo);
        $('.clave-catastral').val('');
        tipoControl(tipo);
        $('.clave-catastral').focus();
    });

    function tipoControl(tipo){
        if (tipo == 'cuenta') {
            $('.clave-catastral').mask("00-S-000000", {
                placeholder: "__-_-______",
                translation: {S: {pattern: /[RUru]/}}
            });
            $('.control-clave-cuenta .dropdown-label').text('Cuenta');
        }
        else {
            $('.clave-catastral').mask("00-000-000-0000-000000", {placeholder: "__-___-___-____-______"});
            $('.control-clave-cuenta .dropdown-label').text('Clave');
        }
    };

});
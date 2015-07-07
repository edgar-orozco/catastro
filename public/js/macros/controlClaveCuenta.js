/**
 * Script para dar funcionalidad al control de clave o cuenta con mask input
 */

$(function () {
    //Inicializamos el campo con una máscara por cuenta catastral
    $('.clave-catastral').mask("00-S-000000", {
        placeholder: "__-_-______",
        translation: {S: {pattern: /[RUru]/}}
    });

    //Cuando se selecciona un valor del dropdown del buscador entonces:
    $('.dropdown-menu.tipo-busqueda li a').click(function () {
        var tipo = $(this).data('tipo');
        $('.select-busqueda').data('tipobusqueda', tipo);
        $('.clave-catastral').val('');
        if (tipo == 'cuenta') {
            $('.clave-catastral').mask("00-S-000000", {
                placeholder: "__-_-______",
                translation: {S: {pattern: /[RUru]/}}
            });
            $('.control-clave-cuenta .dropdown-label').text('Cuenta');
            $('.clave-catastral').focus();
        }
        else {
            $('.clave-catastral').mask("00-000-000-0000-000000", {placeholder: "__-___-___-____-______"});
            $('.control-clave-cuenta .dropdown-label').text('Clave');
            $('.clave-catastral').focus();
        }
    });
});
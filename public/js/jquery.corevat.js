/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     *  
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $('.corevatDataTable').dataTable({
        language: {
            lengthMenu: "Mostrar _MENU_ Registros por página",
            zeroRecords: "No se encontraron registros",
            info: "Mostrando pagina _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros", "search": "Filter records:",
            search: "Buscar: ", "infoFiltered": "(Filtrado en _MAX_ total de registros)",
            oPaginate: {
                sPrevious: "Anterior",
                sNext: "Siguiente"
            }
        },
        ordering: true,
        searching: false,
        lengthMenu: [10, 20, 30]
    });

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemCompTerrenos = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="ubicacion">Ubicación:</label>').appendTo(div);
        $('<input type="text" name="ubicacion" id="ubicacion" value="" maxlength="200"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio">Precio:</label>').appendTo(div);
        $('<input type="number" name="precio" id="precio" value="0.00" min="0.00" max="9999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="number" name="superficie_terreno" id="superficie_terreno" value="0.00" min="0.00" max="9999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio_unitario_m2_terreno">Precio Unitario M&sup2; Terreno:</label>').appendTo(div);
        $('<input type="text" name="precio_unitario_m2_terreno" id="precio_unitario_m2_terreno" />').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="observaciones">Observaciones:</label>').appendTo(div);
        $('<input type="text" name="observaciones" id="observaciones" value="" maxlength="100"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemHomologacion = function () {
        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="comparable">Comparable:</label>').appendTo(div);
        $('<input type="text" name="comparable" id="comparable"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="text" name="superficie_terreno" id="superficie_terreno"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_unitario">Valor Unitario:</label>').appendTo(div);
        $('<input type="text" name="valor_unitario" id="valor_unitario"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorzona">Zona:</label>').appendTo(div);
        $('#idfactorzona').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorubicacion">Ubicación:</label>').appendTo(div);
        $('#idfactorubicacion').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorfrente">Frete:</label>').appendTo(div);
        $('#idfactorfrente').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorforma">Forma:</label>').appendTo(div);
        $('#idfactorforma').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="superficie">Superficie:</label>').appendTo(div);
        $('<input type="text" name="superficie" id="superficie"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_unitario_negociable">Negociación:</label>').appendTo(div);
        $('<input type="number" name="valor_unitario_negociable" id="valor_unitario_negociable" value="0.00" min="0.00" max="9999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_unitario_resultante_m2">Resultante ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_resultante_m2" id="valor_unitario_resultante_m2"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="in_promedio">Interviene en el Promedio:</label>').appendTo(div);
        $('<input type="checkbox" name="in_promedio" id="in_promedio" />').appendTo(div);
        div.appendTo('#containerDialogForm');

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemInformacion = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="ubicacion">Ubicacion:</label>').appendTo(div);
        $('<input type="text" name="ubicacion" id="ubicacion" value="" maxlength="200"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0.00" min="0.00" max="9999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="telefono">Teléfono:</label>').appendTo(div);
        $('<input type="text" name="telefono" id="telefono" value="" maxlength="100"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="observaciones">Observaciones:</label>').appendTo(div);
        $('<input type="text" name="observaciones" id="observaciones" value="" maxlength="100"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemAnalisis = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio_venta">Precio de Venta:</label>').appendTo(div);
        $('<input type="number" name="precio_venta" id="precio_venta" value="0.00" min="0.00" max="9999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="number" name="superficie_terreno" id="superficie_terreno" value="0.00" min="0.00" max="999999999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_construccion">Superficie de la Construcción:</label>').appendTo(div);
        $('<input type="number" name="superficie_construccion" id="superficie_construccion" value="0.00" min="0.00" max="999999999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_unitario_m2">Valor Unitario ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_m2" id="valor_unitario_m2"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_zona">Zona:</label>').appendTo(div);
        $('<select name="factor_zona" id="factor_zona"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_ubicacion">Ubicación:</label>').appendTo(div);
        $('<select name="factor_ubicacion" id="factor_ubicacion"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_superficie">Factor Superficie:</label>').appendTo(div);
        $('<input type="number" name="factor_superficie" id="factor_superficie" value="0.00" min="0.00" max="999999999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_superficie">Factor Edad:</label>').appendTo(div);
        $('<input type="number" name="factor_edad" id="factor_edad" value="0.00" min="0.00" max="999999999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_conservacion">Conservación:</label>').appendTo(div);
        $('<select name="factor_conservacion" id="factor_conservacion"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_negociacion">Negociación:</label>').appendTo(div);
        $('<input type="number" name="factor_negociacion" id="factor_negociacion" value="0.00" min="0.00" max="999999999999.99º" step="0.01"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_unitario_resultante_m2">Resultante ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_resultante_m2" id="valor_unitario_resultante_m2"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="in_promedio">Interviene en el Promedio:</label>').appendTo(div);
        $('<input type="checkbox" name="in_promedio" id="in_promedio" />').appendTo(div);
        div.appendTo('#containerDialogForm');

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemCompTerrenos = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemCompTerrenosGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
                $('#ubicacion').val(datos.ubicacion);
                $('#precio').val(datos.precio);
                $('#superficie_terreno').val(datos.superficie_terreno);
                $('#precio_unitario_m2_terreno').val(datos.precio_unitario_m2_terreno);
                $('#observaciones').val(datos.observaciones);
            }
        });

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemHomologacion = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemHomologacionGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
                $('#comparable').val(datos.comparable);
                $('#superficie_terreno').val(datos.superficie_terreno);
                $('#valor_unitario').val(datos.valor_unitario)
                $("#idfactorzona option[text=" + datos.zona + "]").attr("selected", true);
                $("#idfactorubicacion option[text=" + datos.ubicacion + "]").attr("selected", true);
                $("#idfactorfrente option[text=" + datos.frente + "]").attr("selected", true);
                $("#idfactorforma option[text=" + datos.forma + "]").attr("selected", true);
                $('#superficie').val(datos.superficie);
                $('#valor_unitario_negociable').val(datos.valor_unitario_negociable);
                $('#valor_unitario_resultante_m2').val(datos.valor_unitario_resultante_m2);
                $('#in_promedio').val(datos.in_promedio);
            }
        });
    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemInformacion = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemInformacionGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemAnalisis = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemAnalisisGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefHomologacion = function () {
        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="comparable">Comparable:</label>').appendTo(div);
        $('<input type="text" name="comparable" id="comparable"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
    }
    
    
    
    
    
    
    
    
    
});

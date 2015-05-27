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
	if ( $('#fecha_reporte') || $('#fecha_reporte') ) {
		$('#fecha_reporte, #fecha_avaluo').datepicker();
	}
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
    $.createFormAefTerrenos = function () {
        div = $('<div  />');
        div.addClass('col-md-4');
        $('<label for="fraccion">Fracción:</label>').appendTo(div);
        $('<input type="text" name="fraccion" id="fraccion" maxlength="50" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="superficie">Superficie:</label>').appendTo(div);
        $('<input type="text" name="superficie" id="superficie"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="irregular">Irregular:</label>').appendTo(div);
        $('<input type="number" name="irregular" id="irregular" value="0.00" max="9999999.99" maxlength="10" min="0.00" pattern="[0-9]{10}" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="top">Top:</label>').appendTo(div);
        $('<select name="top" id="top" class="form-control" style="width:100%"><option value="0">PENDIENTE</option></select>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorfrente">Frente:</label>').appendTo(div);
        $('#idfactorfrente').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorforma">Forma:</label>').appendTo(div);
        $('#idfactorforma').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorconservacion">Otros:</label>').appendTo(div);
        $('#idfactorconservacion').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">F. Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_unitario_neto">V.U. Neto:</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_neto" id="valor_unitario_neto"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="indiviso">Indiviso (%):</label>').appendTo(div);
        $('<input type="number" name="indiviso" id="irregular" value="0.00" max="9999999.99" maxlength="10" min="0.00" pattern="[0-9]{10}" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_parcial">V. Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-4').appendTo('#containerDialogForm');
		
    };
	
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * DATOS DE LA CONSTRUCCION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefConstrucciones = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('#idtipo').appendTo(div);
        div.appendTo('#containerDialogForm');
	
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="text" name="edad" id="edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_m2">Superficie M&sup2:</label>').appendTo(div);
        $('<input type="text" name="superficie_m2" id="superficie_m2"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_nuevo">V.R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0.00" max="9999999.99" maxlength="10" min="0.00" pattern="[0-9]{10}" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_edad">Factor Conservación:</label>').appendTo(div);
        $('#idfactorconservacion').appendTo(div);
        div.appendTo('#containerDialogForm');
	
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_neto">Valor Neto:</label>').appendTo(div);
        $('<input type="text" name="valor_neto" id="valor_neto"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_parcial_construccion">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial_construccion" id="valor_parcial_construccion"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefCondominios = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="descripcion">Descripción:</label>').appendTo(div);
        $('<input type="text" name="descripcion" id="descripcion" maxlength="200" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="cantidad">Cantidad:</label>').appendTo(div);
        $('<input type="number" name="cantidad" id="cantidad" value="0.00" max="9999999.99" maxlength="10" min="0.00" pattern="[[-+]?[0-9]*[.,]?[0-9]+" step="0.01" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="unidad">Unidad:</label>').appendTo(div);
        $('<input type="text" name="unidad" id="unidad" maxlength="10" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_nuevo">V. R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0" max="9999999999" maxlength="10" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="vida_util">Vida Útil:</label>').appendTo(div);
        $('<input type="number" name="vida_util" id="vida_util" value="0" max="9999999999" maxlength="10" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0" max="9999999999" maxlength="10" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_conservacion">Factor Conservación:</label>').appendTo(div);
        $('<input type="number" name="factor_conservacion" id="factor_conservacion" value="0" max="9999999999" maxlength="10" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_neto">Indiviso (%):</label>').appendTo(div);
        $('<input type="number" name="valor_neto" id="indiviso" value="0" max="9999999999" maxlength="10" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_parcial">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefCompConstrucciones = function () {
    }
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefInstalaciones = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="idfactorconservacion">Descripción:</label>').appendTo(div);
        $('#idfactorconservacion').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="cantidad">Cantidad:</label>').appendTo(div);
        $('<input type="number" name="cantidad" id="cantidad" value="0.00" max="9999999.99" maxlength="10" min="0.00" pattern="[0-9]{10}" step="0.01" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="unidad">Unidad:</label>').appendTo(div);
        $('<input type="number" name="unidad" id="unidad" value="0.00" max="9999999.99" maxlength="10" min="0.00" pattern="[0-9]{10}" step="0.01" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="vida_remanente">Vida Útil:</label>').appendTo(div);
        $('<input type="number" name="vida_remanente" id="vida_remanente" value="0" max="9999999999" maxlength="10" min="0" pattern="[0-9]{10}" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0" max="9999999999" maxlength="10" min="0" pattern="[0-9]{10}" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_conservacion">actor Conservación:</label>').appendTo(div);
        $('<input type="number" name="factor_conservacion" id="factor_conservacion" value="0" max="9999999999" maxlength="10" min="0" pattern="[0-9]{10}" step="1" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="indiviso">V. N. Rep.:</label>').appendTo(div);
        $('<input type="text" name="indiviso" id="indiviso"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_parcial">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
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
    $.loadFormAefTerrenos = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefTerrenoGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefConstrucciones = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefConstruccionesGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefCondominios = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefCondominiosGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefCompConstrucciones = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefCompConstruccionesGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefInstalaciones = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefInstalacionesGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };
    
    
});

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
	if ( $('#fecha_reporte') && $('#fecha_avaluo') ) {
		$('#fecha_reporte').datepicker({
			onClose: function( selectedDate ) {
				$( "#fecha_avaluo" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
		$('#fecha_avaluo').datepicker({
			onClose: function( selectedDate ) {
				$( "#fecha_reporte" ).datepicker( "option", "minDate", selectedDate );
			}
		});
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
        $('<input type="number" name="precio" id="precio" value="0.00" min="0.00" max="99999999.99" step="0.01" size="11" pattern="[0-9]{8}[.]{1}[0-9]{2}" style="width:200px;" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="number" name="superficie_terreno" id="superficie_terreno" value="0.00" min="0.00" max="9999999.99" step="0.01" size="11" pattern="[0-9]{8}[.]{1}[0-9]{2}" style="width:200px;" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio_unitario_m2_terreno">Precio Unitario M&sup2; Terreno:</label>').appendTo(div);
        $('<input type="text" name="precio_unitario_m2_terreno" id="precio_unitario_m2_terreno" size="11" style="width:200px;" />').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="observaciones">Observaciones:</label>').appendTo(div);
        $('<input type="text" name="observaciones" id="observaciones" value="" maxlength="100"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        $("input[type=number]").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


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
		$('<select id="idfactorzona" name="idfactorzona"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorubicacion">Ubicación:</label>').appendTo(div);
		$('<select id="idfactorubicacion" name="idfactorubicacion"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorfrente">Frente:</label>').appendTo(div);
		$('<select id="idfactorfrente" name="idfactorfrente"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorforma">Forma:</label>').appendTo(div);
		$('<select id="idfactorforma" name="idfactorforma"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="superficie">Superficie:</label>').appendTo(div);
        $('<input type="text" name="superficie" id="superficie"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_unitario_negociable">Negociación:</label>').appendTo(div);
        $('<input type="number" name="valor_unitario_negociable" id="valor_unitario_negociable" value="0.00" min="0.00" max="0.99º" step="0.01" regex="[0]{1}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
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
        $('<input type="number" name="edad" id="edad" value="0.00" min="0.00" max="9999999.99" step="0.01" pattern="[0-9]{1,8}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
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

        $("input[type=number]").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemAnalisis = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio_venta">Precio de Venta:</label>').appendTo(div);
        $('<input type="number" name="precio_venta" id="precio_venta" value="0.00" min="0.00" max="9999999999999.99" step="0.01" pattern="[0-9]{1,13}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="number" name="superficie_terreno" id="superficie_terreno" value="0.00" min="0.00" max="9999999999999.99" step="0.01" pattern="[0-9]{1,13}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_construccion">Superficie de la Construcción:</label>').appendTo(div);
        $('<input type="number" name="superficie_construccion" id="superficie_construccion" value="0.00" min="0.00" max="9999999999999.99" step="0.01" pattern="[0-9]{1,13}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_unitario_m2">Valor Unitario ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_m2" id="valor_unitario_m2"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="idfactorzona">Zona:</label>').appendTo(div);
        $('<select name="idfactorzona" id="idfactorzona"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="idfactorubicacion">Ubicación:</label>').appendTo(div);
        $('<select name="idfactorubicacion" id="idfactorubicacion"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_superficie">Factor Superficie:</label>').appendTo(div);
        $('<input type="number" name="factor_superficie" id="factor_superficie" value="0.00" min="0.00" max="100.00" step="0.01" pattern="[0-9]{1,3}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="number" name="factor_edad" id="factor_edad" value="0.00" min="0.00" max="99999999.99" step="0.01" pattern="[0-9]{1,8}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="idfactorconservacion">Conservación:</label>').appendTo(div);
        $('<select name="idfactorconservacion" id="idfactorconservacion"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_negociacion">Negociación:</label>').appendTo(div);
        $('<input type="number" name="factor_negociacion" id="factor_negociacion" value="0.00" min="0.00" max="100.00º" step="0.01" pattern="[0-9]{1,3}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_unitario_resultante_m2">Resultante ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_resultante_m2" id="valor_unitario_resultante_m2"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
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
        $('<input type="number" name="irregular" id="irregular" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[-+]?[0-9]*[.,]?[0-9]+" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactortop">Top:</label>').appendTo(div);
        $('<select name="idfactortop" id="idfactortop" class="form-control" style="width:100%" />').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorfrente">Frente:</label>').appendTo(div);
        $('<select name="idfactorfrente" id="idfactorfrente" class="form-control" style="width:100%" />').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorforma">Forma:</label>').appendTo(div);
        $('<select name="idfactorforma" id="idfactorforma" class="form-control" style="width:100%"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorconservacion">Otros:</label>').appendTo(div);
        $('<select name="idfactorconservacion" id="idfactorconservacion" class="form-control" style="width:100%"/>').appendTo(div);
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
        $('<input type="number" name="indiviso" id="indiviso" value="0.01" min="0" max="100" pattern="[-+]?[0-9]*[.,]?[0-9]+" step="0.01" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_parcial">V. Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-4').appendTo('#containerDialogForm');

        $("#idfactortop, #irregular, #indiviso").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

		
    };
	
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * DATOS DE LA CONSTRUCCION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefConstrucciones = function () {
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idtipo">Tipo:</label>').appendTo(div);
        $('<select name="idtipo" id="idtipo" class="form-control" style="width:100%"></select>').appendTo(div);
        div.appendTo('#containerDialogForm');
	
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="text" name="edad" id="edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="superficie_m2">Superficie M&sup2:</label>').appendTo(div);
        $('<input type="text" name="superficie_m2" id="superficie_m2"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_nuevo">V.R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorconservacion">Factor Conservación:</label>').appendTo(div);
        $('<select name="idfactorconservacion" id="idfactorconservacion" class="form-control" style="width:100%"></select>').appendTo(div);
        div.appendTo('#containerDialogForm');
	
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_neto">Valor Neto:</label>').appendTo(div);
        $('<input type="text" name="valor_neto" id="valor_neto"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_parcial_construccion">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial_construccion" id="valor_parcial_construccion"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * Áreas y Elementos adicionales comunes(solo en Condominios)
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefCondominios = function () {
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="descripcion">Descripción:</label>').appendTo(div);
        $('<input type="text" name="descripcion" id="descripcion" maxlength="200" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="unidad">Unidad:</label>').appendTo(div);
        $('<input type="text" name="unidad" id="unidad" maxlength="10" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="cantidad">Cantidad:</label>').appendTo(div);
        $('<input type="number" name="cantidad" id="cantidad" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_nuevo">V. R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="vida_remanente">Vida Remanente:</label>').appendTo(div);
        $('<input type="number" name="vida_remanente" id="vida_remanente" value="0" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_conservacion">Factor Conservación:</label>').appendTo(div);
        $('<input type="number" name="factor_conservacion" id="factor_conservacion" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="indiviso">Indiviso (%):</label>').appendTo(div);
        $('<input type="number" name="indiviso" id="indiviso" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_parcial">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        $("input[type=number], #unidad").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefCompConstrucciones = function () {
    }
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * Instalaciones Especiales, Elementos, Accesorios y Obras Complementarias
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefInstalaciones = function () {
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idobracomplementaria">Descripción:</label>').appendTo(div);
        $('<select name="idobracomplementaria" id="idobracomplementaria" class="form-control" style="width:100%"></select>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="cantidad">Cantidad:</label>').appendTo(div);
        $('<input type="number" name="cantidad" id="cantidad" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="unidad">Unidad:</label>').appendTo(div);
        $('<input type="text" name="unidad" id="unidad"  value="0" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_nuevo">V. R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="eaf_Instalacion_vida_util">Vida Útil:</label>').appendTo(div);
        $('<input type="text" name="eaf_Instalacion_vida_util" id="eaf_Instalacion_vida_util" value="0" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_conservacion">Factor Conservación:</label>').appendTo(div);
        $('<input type="number" name="factor_conservacion" id="factor_conservacion" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_neto">V. N. Rep.:</label>').appendTo(div);
        $('<input type="text" name="valor_neto" id="valor_neto"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_parcial">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        $("input[type=number], #factor_conservacion, #cantidad, #unidad, #valor_nuevo, #eaf_Instalacion_vida_util, #edad ").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

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
                $('#valor_unitario').val(datos.valor_unitario);
				
				for (var i = 0; i < datos.cat_factores_zonas.length; i++) {
					$('<option value="' + datos.cat_factores_zonas[i].idfactorzona + '">('+ datos.cat_factores_zonas[i].valor_factor_zona  + ') ' + datos.cat_factores_zonas[i].factor_zona + '</option>').appendTo('#idfactorzona');
				}
                $("#idfactorzona option[value=" + datos.idfactorzona + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_ubicacion.length; i++) {
					$('<option value="' + datos.cat_factores_ubicacion[i].idfactorubicacion + '">('+ datos.cat_factores_ubicacion[i].valor_factor_ubicacion  + ') ' + datos.cat_factores_ubicacion[i].factor_ubicacion + '</option>').appendTo('#idfactorubicacion');
				}
                $("#idfactorubicacion option[value=" + datos.idfactorubicacion + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_frente.length; i++) {
					$('<option value="' + datos.cat_factores_frente[i].idfactorfrente + '">('+ datos.cat_factores_frente[i].valor_factor_frente  + ') ' + datos.cat_factores_frente[i].factor_frente + '</option>').appendTo('#idfactorfrente');
				}
                $("#idfactorfrente option[value=" + datos.idfactorfrente + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_forma.length; i++) {
					$('<option value="' + datos.cat_factores_forma[i].idfactorforma + '">('+ datos.cat_factores_forma[i].valor_factor_forma  + ') ' + datos.cat_factores_forma[i].factor_forma + '</option>').appendTo('#idfactorforma');
				}
                $("#idfactorforma option[value=" + datos.idfactorforma + "]").attr("selected", true);
				
                $('#superficie').val(datos.superficie);
                $('#valor_unitario_negociable').val(datos.valor_unitario_negociable);
                $('#valor_unitario_resultante_m2').val(datos.valor_unitario_resultante_m2);
				$('#in_promedio').prop('checked',  (datos.in_promedio === 1 ? true:false) );
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
                $('#ubicacion').val(datos.ubicacion);
                $('#edad').val(datos.edad);
                $('#telefono').val(datos.telefono);
                $('#observaciones').val(datos.observaciones);

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
                $('#precio_venta').val(datos.precio_venta);
                $('#superficie_terreno').val(datos.superficie_terreno);
                $('#superficie_construccion').val(datos.superficie_construccion);
                $('#valor_unitario_m2').val(datos.valor_unitario_m2);
				
				for (var i = 0; i < datos.cat_factores_zonas.length; i++) {
					$('<option value="' + datos.cat_factores_zonas[i].idfactorzona + '">('+ datos.cat_factores_zonas[i].valor_factor_zona  + ') ' + datos.cat_factores_zonas[i].factor_zona + '</option>').appendTo('#idfactorzona');
				}
                $("#idfactorzona option[value=" + datos.idfactorzona + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_ubicacion.length; i++) {
					$('<option value="' + datos.cat_factores_ubicacion[i].idfactorubicacion + '">('+ datos.cat_factores_ubicacion[i].valor_factor_ubicacion  + ') ' + datos.cat_factores_ubicacion[i].factor_ubicacion + '</option>').appendTo('#idfactorubicacion');
				}
                $("#idfactorubicacion option[value=" + datos.idfactorubicacion + "]").attr("selected", true);
				
                $('#factor_superficie').val(datos.factor_superficie);
                $('#factor_edad').val(datos.factor_edad);
				
				for (var i = 0; i < datos.cat_factores_conservacion.length; i++) {
					$('<option value="' + datos.cat_factores_conservacion[i].idfactorconservacion + '">('+ datos.cat_factores_conservacion[i].valor_factor_conservacion  + ') ' + datos.cat_factores_conservacion[i].factor_conservacion + '</option>').appendTo('#idfactorconservacion');
				}
                $("#idfactorconservacion option[value=" + datos.idfactorconservacion + "]").attr("selected", true);
				
                $('#factor_negociacion').val(datos.factor_negociacion);
                $('#factor_resultante').val(datos.factor_resultante);
                $('#valor_unitario_resultante_m2').val(datos.valor_unitario_resultante_m2);
				$('#in_promedio').prop('checked',  (datos.in_promedio === 1 ? true:false) );
            }
        });
    };

    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefTerrenos = function () {
        var xx = $('#idTable').val();
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefTerrenosGet/' + $('#idTable').val() + '/' + $('#idAef').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
				
                for (var i = 0; i < datos.cat_factores_top.length; i++) {
                    $('<option value="' + datos.cat_factores_top[i].idfactorconservacion + '">('+ datos.cat_factores_top[i].valor_factor_conservacion  + ') ' + datos.cat_factores_top[i].factor_conservacion + '</option>').appendTo('#idfactortop');
                }
                $("#idfactortop option[value=" + datos.idfactortop + "]").attr("selected", true);

				for (var i = 0; i < datos.cat_factores_frente.length; i++) {
					$('<option value="' + datos.cat_factores_frente[i].idfactorfrente + '">('+ datos.cat_factores_frente[i].valor_factor_frente  + ') ' + datos.cat_factores_frente[i].factor_frente + '</option>').appendTo('#idfactorfrente');
				}
                $("#idfactorfrente option[value=" + datos.idfactorfrente + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_forma.length; i++) {
					$('<option value="' + datos.cat_factores_forma[i].idfactorforma + '">('+ datos.cat_factores_forma[i].valor_factor_forma  + ') ' + datos.cat_factores_forma[i].factor_forma + '</option>').appendTo('#idfactorforma');
				}
                $("#idfactorforma option[value=" + datos.idfactorforma + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_conservacion.length; i++) {
					$('<option value="' + datos.cat_factores_conservacion[i].idfactorconservacion + '">('+ datos.cat_factores_conservacion[i].valor_factor_conservacion  + ') ' + datos.cat_factores_conservacion[i].factor_conservacion + '</option>').appendTo('#idfactorconservacion');
				}
                $("#idfactorconservacion option[value=" + datos.idfactorconservacion + "]").attr("selected", true);

				$('#fraccion').val( datos.fraccion );
				$('#superficie').val(datos.superficie);
				$('#irregular').val(datos.irregular);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#valor_unitario_neto').val(datos.valor_unitario_neto);
				$('#indiviso').val(datos.indiviso);
				$('#valor_parcial').val(datos.valor_parcial);
				
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
				
				for (var i = 0; i < datos.cat_tipo.length; i++) {
					$('<option value="' + datos.cat_tipo[i].idtipo + '">' + datos.cat_tipo[i].tipo + '</option>').appendTo('#idtipo');
				}
                $("#idtipo option[value=" + datos.idtipo + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_conservacion.length; i++) {
					$('<option value="' + datos.cat_factores_conservacion[i].idfactorconservacion + '">('+ datos.cat_factores_conservacion[i].valor_factor_conservacion  + ') ' + datos.cat_factores_conservacion[i].factor_conservacion + '</option>').appendTo('#idfactorconservacion');
				}
                $("#idfactorconservacion option[value=" + datos.idfactorconservacion + "]").attr("selected", true);
				
				$('#edad').val(datos.edad);
				$('#superficie_m2').val(datos.superficie_m2);
				$('#valor_nuevo').val(datos.valor_nuevo);
				$('#factor_edad').val(datos.factor_edad);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#valor_neto').val(datos.valor_neto);
				$('#valor_parcial_construccion').val(datos.factor_edad);

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
				
				$('#descripcion').val(datos.descripcion);
				$('#unidad').val(datos.unidad);
				$('#cantidad').val(datos.cantidad);
				$('#valor_nuevo').val(datos.valor_nuevo);
				$('#vida_remanente').val(datos.vida_remanente);
				$('#edad').val(datos.edad);
				$('#factor_edad').val(datos.factor_edad);
				$('#factor_conservacion').val(datos.factor_conservacion);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#indiviso').val(datos.indiviso);
				$('#valor_parcial').val(datos.valor_parcial);

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
				
				for (var i = 0; i < datos.cat_obras_complementarias.length; i++) {
					$('<option value="' + datos.cat_obras_complementarias[i].idobracomplementaria + '">' + datos.cat_obras_complementarias[i].obra_complementaria + '</option>').appendTo('#idobracomplementaria');
				}
                $("#idobracomplementaria option[value=" + datos.idobracomplementaria + "]").attr("selected", true);
				
				$('#cantidad').val(datos.cantidad);
				$('#unidad').val(datos.unidad);
				$('#valor_nuevo').val(datos.valor_nuevo);
				$('#eaf_Instalacion_vida_util').val(datos.vida_util);
				$('#edad').val(datos.edad);
				$('#factor_edad').val(datos.factor_edad);
				$('#factor_conservacion').val(datos.factor_conservacion);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#valor_neto').val(datos.valor_neto);
				$('#valor_parcial').val(datos.valor_parcial);
				
			}
		});
	};

    // Va la validación a pie con JS Pure
    $("input[type=number], .clsNumeric").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            (e.keyCode == 88 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
             return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

	if ( $("#formAvaluoZona") ) {
		
		if ($('#is_otro_servicio').val() === '1') {
			$('#otro_servicio_municipal').prop('disabled', false);
		} else {
			$('#otro_servicio_municipal').prop('disabled', true);
		}
		
		$('#is_otro_servicio').click(function () {
			if (this.checked) {
				$(this).val('1');
				$('#otro_servicio_municipal').prop('disabled', false);
			} else {
				$(this).val('0');
				$('#otro_servicio_municipal').prop('disabled', true);
			}
		});
		
		if ($('#is_otro_equipamiento').val() === '1') {
			$('#otro_equipamiento').prop('disabled', false);
		} else {
			$('#otro_equipamiento').prop('disabled', true);
		}
		
		$('#is_otro_equipamiento').click(function () {
			if (this.checked) {
				$(this).val('1');
				$('#otro_equipamiento').prop('disabled', false);
			} else {
				$(this).val('0');
				$('#otro_equipamiento').prop('disabled', true);
			}
		});

	}
	
/*

*/


});

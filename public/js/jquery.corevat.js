/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var corevatDataTable;

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
	corevatDataTable = $('.corevatDataTable').DataTable({
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

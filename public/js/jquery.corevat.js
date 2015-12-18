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
	if ($('#fecha_reporte') && $('#fecha_avaluo')) {
		$('#fecha_reporte').datepicker({
			onClose: function (selectedDate) {
				$("#fecha_avaluo").datepicker("option", "maxDate", selectedDate);
			}
		});
		$('#fecha_avaluo').datepicker({
			onClose: function (selectedDate) {
				$("#fecha_reporte").datepicker("option", "minDate", selectedDate);
			}
		});
	}
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

	$.extend($.fn.dataTable.defaults, {
		language: {
			lengthMenu: "Mostrar _MENU_ Registros por página",
			zeroRecords: "No se encontraron registros",
			info: "Mostrando pagina _PAGE_ de _PAGES_",
			infoEmpty: "No hay registros",
			emptyTable: "No hay registros",
			search: "Buscar: ",
			infoFiltered: "(Filtrado en _MAX_ total de registros)",
			oPaginate: {
				sPrevious: "Anterior",
				sNext: "Siguiente"
			}
		},
		ordering: true,
		searching: false,
		lengthMenu: [10, 20, 30]
	});

	$('#corevatConfirmButton').click(function () {
		
		var ctrl = $(this).attr('ctrl');
		var url = '';
		var datatable = null;

		if ( ctrl === 'registrarAvaluo' ) {
			$.registra($(this).attr('idTable'));
		} else {
			
			if (ctrl === 'delAiMedidasColindancias') {
				url = '/corevat/AiMedidasColindanciasDel/' + $(this).attr('idTable');
				datatable = aiMedidasColindancias;

			} else if (ctrl === 'delAiAcabados') {
				url = '/corevat/AiAcabadosDel/' + $(this).attr('idTable');
				datatable = aiAcabados;

			} else if (ctrl === 'delAemCompTerrenos') {
				url = '/corevat/AemCompTerrenosDel/' + $(this).attr('idTable');
				datatable = aemCompTerrenos;

			} else if (ctrl === 'delAemInformacion') {
				url = '/corevat/AemInformacionDel/' + $(this).attr('idTable');
				datatable = aemInformacion;

			} else if (ctrl === 'delAefTerrenos') {
				url = '/corevat/AefTerrenosDel/' + $(this).attr('idTable');
				datatable = aefTerrenos;

			} else if (ctrl === 'delAefConstrucciones') {
				url = '/corevat/AefConstruccionesDel/' + $(this).attr('idTable');
				datatable = aefConstrucciones;

			} else if (ctrl === 'delAefCondominios') {
				url = '/corevat/AefCondominiosDel/' + $(this).attr('idTable');
				datatable = aefCondominios;

			} else if (ctrl === 'delAefInstalaciones') {
				url = '/corevat/AefInstalacionesDel/' + $(this).attr('idTable');
				datatable = aefInstalaciones;

			}
			$.ajax({
				global: false,
				cache: false,
				dataType: 'json',
				url: url,
				type: 'get',
				success: function (data) {
					datos = eval(data);
					if (datos.success === true) {
						datatable.ajax.reload();
						if (ctrl === 'delAemCompTerrenos') {
							aemHomologacion.ajax.reload();
							$('#valor_unitario_promedio').empty().append(datos.valor_unitario_promedio);
							$('#valor_aplicado_m2').empty().append(datos.valor_aplicado_m2);

						} else if (ctrl === 'delAemInformacion') {
							aemAnalisis.ajax.reload();

						} else if (ctrl === 'delAefTerrenos') {
							$('#valor_terreno').empty().append(datos.valor_aplicado_m2);
							$('#total_valor_fisico').empty().append(datos.total_valor_fisico);

						} else if (ctrl === 'delAefConstrucciones') {
							$('#total_metros_construccion').empty().append(datos.total_metros_construccion);
							$('#valor_construccion').empty().append(datos.valor_construccion);
							$('#total_valor_fisico').empty().append(datos.total_valor_fisico);
							$('#subtotal_construccion').val(datos.subtotal_construccion);
							$('#diferencia_construccion').val(datos.diferencia_construccion);

						} else if (ctrl === 'delAefCondominios') {
							$('#subtotal_area_condominio').empty().append(datos.subtotal_area_condominio);
							$('#total_valor_fisico').empty().append(datos.total_valor_fisico);

						} else if (ctrl === 'delAefInstalaciones') {
							$('#subtotal_instalaciones_especiales').empty().append(datos.subtotal_instalaciones_especiales);
							$('#total_valor_fisico').empty().append(datos.total_valor_fisico);
						}
						$('#corevatConfirmMessage').empty().append('¡El registro fue eliminado!').addClass('alert-success');
						$('#corevatConfirmButton').hide();
					}
				}
			});
		}
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#corevatConfirm').on('hidden.bs.modal', function (e) {
		$('#corevatConfirmButton').show().attr('ctrl', '').attr('idTable', '');
		$('#corevatConfirmContainer').empty();
		$('#corevatConfirmMessage').empty().removeClass('alert-success');
	});
	

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('.textareanoenter').keypress(function(event) {
		if (event.keyCode == 13) {
			event.preventDefault();
		}
	});


});

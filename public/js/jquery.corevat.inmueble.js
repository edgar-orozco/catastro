/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var corevatDataTable;
$(document).ready(function () {
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#btn3Inmueble').removeClass("btn-info").addClass("btn-primary");

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		corevatDataTable.column( 1 ).visible( false );
		corevatDataTable.column( 5 ).visible( false );
		corevatDataTable.ajax.url( '/corevat/AiMedidasColindanciasGetAjax/' + $("#idavaluoinmueble").val() ).load();
		
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#btnNew').click(function () {
			$('#ctrl').val('ins');
			$('#idaimedidacolindancia, #medidas').val('0');
			$('#colindancia').val('');
			$("#idorientacion option[value=1]").attr("selected", true);
			$('#divDialogForm').dialog({title: 'Capturar un nuevo registro'}).dialog('open');
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$.editAiMedidasColindancias = function(id) {
			$('#ctrl').val('upd');
			$('#idaimedidacolindancia').val(id);
			$.ajax({
				global: false,
				cache: false,
				dataType: 'json',
				url: '/corevat/AiMedidasColindanciasGet/' + $('#idaimedidacolindancia').val(),
				type: 'get',
				success: function (data) {
					datos = eval(data);
					$("#idorientacion option[value=" + datos.idorientacion + "]").attr("selected", true);
					$('#medida').val(datos.medida);
					$('#medidas').val(datos.medidas);
					$('#unidad_medida').val(datos.unidad_medida);
					$('#colindancia').val(datos.colindancia);
					$('#divDialogForm').dialog({title: 'Modificar registro'}).dialog('open');
				}
			});
		};
		
		$.delAiMedidasColindancias = function(id) {
			$('#idaimedidacolindancia').val(id);
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		}
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('.btnDel').click(function () {
			$('#idaimedidacolindancia').val($(this).attr('idAi'));
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$("#formAiMedidasColindancias").submit(function () {
			$('#messagesDialogForm').empty().removeClass();
			$.ajax({
				global: false,
				cache: false,
				dataType: 'json',
				url: $(this).attr("action"),
				type: $(this).attr("method"),
				data: $(this).serialize(),
				success: function (data) {
					datos = eval(data);
					if (datos.success) {
						$('#messagesDialogForm').removeClass().addClass('alert').addClass('alert-success').append(datos.message);
						$('#idTable').val( datos.idTable );
						if ( $('#ctrl').val() == 'ins' ) {
							$('#idaimedidacolindancia, #medidas').val('0');
							$('#colindancia').val('');
							$("#idorientacion option[value=1]").attr("selected", true);
						}
						corevatDataTable.ajax.reload();
					} else {
						var errores = '';
						for(datos in data.errors) {
							errores += '<p>' + data.errors[datos] + '</p>';
						}
						$('#messagesDialogForm').removeClass().addClass('alert').addClass('alert-danger').append(errores);
					}
				}
			});
			return false;
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#divDialogForm').dialog({
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			closeOnEscape: true,
			width: 800,
			height: 450,
			buttons: {
				Guardar: function () {
					$("#formAiMedidasColindancias").submit();
				},
				Cerrar: function () {
					$(this).dialog('close');
				}
			},
			close: function() {
			}
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#divDialogConfirm').dialog({
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			closeOnEscape: true,
			width: 400,
			height: 300,
			buttons: {
				Aceptar: function () {
					$.ajax({
						global: false,
						cache: false,
						dataType: 'json',
						url: '/corevat/AiMedidasColindanciasDel/' + $('#idaimedidacolindancia').val(),
						type: 'get',
						success: function (data) {
							datos = eval(data);
							corevatDataTable.ajax.reload();
							alert(datos.message);
						}
					});
					$('#divDialogConfirm').dialog("close");
				},
				Cancelar: function () {
					$(this).empty().dialog("close");
				}
			}
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#fachada, #croquis').fileinput({
			maxFileSize: 2000,
			maxFileCount: 1,
			allowedFileExtensions: ["gif","jpg","JPG","png"]
		});

});

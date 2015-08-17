/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var aefTerrenos, aefConstrucciones, aefCondominios, aefInstalaciones;

$(document).ready(function () {
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btn3EnfoqueFisico').removeClass("btn-info").addClass("btn-primary");

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 *  
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	aefTerrenos = $('#aefTerrenosDataTable').DataTable();
	aefTerrenos.ajax.url('/corevat/AefTerrenosGetAjax/' + $("#idavaluoenfoquefisico").val()).load();

	aefConstrucciones = $('#aefConstruccionesDataTable').DataTable();
	aefConstrucciones.ajax.url('/corevat/AefConstruccionesGetAjax/' + $("#idavaluoenfoquefisico").val()).load();

	aefCondominios = $('#aefCondominiosDataTable').DataTable();
	aefCondominios.ajax.url('/corevat/AefCondominiosGetAjax/' + $("#idavaluoenfoquefisico").val()).load();

	aefInstalaciones = $('#aefInstalacionesDataTable').DataTable();
	aefInstalaciones.ajax.url('/corevat/AefInstalacionesGetAjax/' + $("#idavaluoenfoquefisico").val()).load();

	$('.edad').mask('YYY', {placeholder: "___", translation: {Y: {pattern: /[0-9]/}}});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefTerr').click(function () {
		$('#formAefTerrenos').attr('action', '/corevat/AefTerrenosNew');
		$('#messagesModalFormAefTerrenos').empty().removeClass();
		$('#ctrlAefTerrenos').val('ins');
		$('#idaefterreno').val('0');
		$('#modalFormAefTerrenosTitle').empty().append('[COREVAT] Nuevo Registro Factores de Eficiencia');
		$('#modalFormAefTerrenos').modal('show');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefCons').click(function () {
		$('#messagesModalFormAefConstrucciones').empty().removeClass();
		$('#ctrlAefConstrucciones').val('ins');
		$('#idaefconstruccion').val('0');
		$('#modalFormAefConstruccionesTitle').empty().append('[COREVAT] Nuevo Construcción');
		$('#modalFormAefConstrucciones').modal('show');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefCon').click(function () {
		$('#messagesModalFormAefCondominios').empty().removeClass();
		$('#ctrlAefCondominios').val('ins');
		$('#idaefcondominio').val('0');
		$('#modalFormAefCondominiosTitle').empty().append('[COREVAT] Nuevo Elemento');
		$('#modalFormAefCondominios').modal('show');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefIns').click(function () {
		$('#messagesModalFormAefInstalaciones').empty().removeClass();
		$('#ctrlAefInstalaciones').val('ins');
		$('#idaefinstalacion').val('0');
		$('#modalFormAefInstalacionesTitle').empty().append('[COREVAT] Nueva Instalación');
		$('#modalFormAefInstalaciones').modal('show');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefTerrenos = function (id) {
		$('#messagesModalFormAefTerrenos').empty().removeClass();
		$('#formAefTerrenos').attr('action', '/corevat/AefTerrenosUpd/' + id);
		$('#ctrlAefTerrenos').val('upd');
		$('#idaefterreno').val(id);
		$.loadFormAefTerrenos(id);
		$('#modalFormAefTerrenosTitle').empty().append('[COREVAT] Factor Eficiencia: ' + id);
		$('#modalFormAefTerrenos').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefConstrucciones = function (id) {
		$('#messagesModalFormAefConstrucciones').empty().removeClass();
		$('#formAefConstrucciones').attr('action', '/corevat/AefConstruccionesUpd/' + id);
		$('#ctrlAefConstrucciones').val('upd');
		$('#idaefconstruccion').val(id);
		$.loadFormAefConstrucciones(id);
		$('#modalFormAefConstruccionesTitle').empty().append('[COREVAT] Construcción: ' + id);
		$('#modalFormAefConstrucciones').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefCondominios = function (id) {
		$('#messagesModalFormAefCondominios').empty().removeClass();
		$('#formAefCondominios').attr('action', '/corevat/AefCondominiosUpd/' + id);
		$('#ctrlAefCondominios').val('upd');
		$('#idaefcondominio').val(id);
		$.loadFormAefCondominios(id);
		$('#modalFormAefCondominiosTitle').empty().append('[COREVAT] Condominios: ' + id);
		$('#modalFormAefCondominios').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefInstalaciones = function (id) {
		$('#messagesModalFormAefInstalaciones').empty().removeClass();
		$('#formAefInstalaciones').attr('action', '/corevat/AefInstalacionesUpd/' + id);
		$('#ctrlAefInstalaciones').val('upd');
		$('#idaefinstalacion').val(id);
		$.loadFormAefInstalaciones(id);
		$('#modalFormAefInstalacionesTitle').empty().append('[COREVAT] Instalaciones: ' + id);
		$('#modalFormAefInstalaciones').modal('show');
	};
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefTerrenos = function (id) {
		$('#corevatConfirmButton').attr('ctrl', 'delAefTerrenos').attr('idTable', id);
		$('#corevatConfirmContainer').empty().append('<h2>¿Realmente dese eliminar el registro?<h2>');
		$('#corevatConfirm').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefConstrucciones = function (id) {
		$('#corevatConfirmButton').attr('ctrl', 'delAefConstrucciones').attr('idTable', id);
		$('#corevatConfirmContainer').empty().append('<h2>¿Realmente dese eliminar el registro?<h2>');
		$('#corevatConfirm').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefCondominios = function (id) {
		$('#corevatConfirmButton').attr('ctrl', 'delAefCondominios').attr('idTable', id);
		$('#corevatConfirmContainer').empty().append('<h2>¿Realmente dese eliminar el registro?<h2>');
		$('#corevatConfirm').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefInstalaciones = function (id) {
		$('#corevatConfirmButton').attr('ctrl', 'delAefInstalaciones').attr('idTable', id);
		$('#corevatConfirmContainer').empty().append('<h2>¿Realmente dese eliminar el registro?<h2>');
		$('#corevatConfirm').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.loadFormAefTerrenos = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AefTerrenosUpd/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);

				$('#fraccion').val(datos.fraccion);
				$('#superficie').val(datos.superficie);
				$('#irregular').val(datos.irregular);

				$("#idfactortop option[value=" + datos.fk_top + "]").attr("selected", true);
				$('#top').val(datos.top);

				$("#idfactorfrente option[value=" + datos.fk_frente + "]").attr("selected", true);
				$('#frente').val(datos.frente);

				$("#idfactorforma option[value=" + datos.fk_forma + "]").attr("selected", true);
				$('#forma').val(datos.forma);

				$("#idfactorotros option[value=" + datos.fk_otros + "]").attr("selected", true);
				$('#otros').val(datos.otros);

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
	$.loadFormAefConstrucciones = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AefConstruccionesUpd/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$("#idtipo option[value=" + datos.idtipo + "]").attr("selected", true);
				$('#edad_construcciones').val(datos.edad);
				$('#superficie_m2').val(datos.superficie_m2);
				$('#valor_nuevo_construcciones').val(datos.valor_nuevo);
				$('#factor_edad_condominios').val(datos.factor_edad);
				$("#idfactorconservacion option[value=" + datos.fk_conservacion + "]").attr("selected", true);
				$('#factor_conservacion_condominios').val(datos.factor_conservacion);
				$('#factor_resultante_condominios').val(datos.factor_resultante);
				$('#valor_neto_construccion').val(datos.valor_neto);
				$('#valor_parcial_construccion').val(datos.factor_edad);

			}
		});
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.loadFormAefCondominios = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AefCondominiosUpd/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$('#descripcion').val(datos.descripcion);
				$('#unidad').val(datos.unidad);
				$('#cantidad_condominios').val(datos.cantidad);
				$('#valor_nuevo_condiminios').val(datos.valor_nuevo);
				$('#vida_remanente').val(datos.vida_remanente);
				$('#edad_condominios').val(datos.edad);
				$('#factor_edad_condominios').val(datos.factor_edad);
				$('#factor_conservacion_condominios').val(datos.factor_conservacion);
				$('#factor_resultante_condominios').val(datos.factor_resultante);
				$('#indiviso_condominios').val(datos.indiviso);
				$('#valor_parcial_condominios').val(datos.valor_parcial);
			}
		});
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.loadFormAefInstalaciones = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AefInstalacionesUpd/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$("#idobracomplementaria option[value=" + datos.idobracomplementaria + "]").attr("selected", true);
				$('#cantidad_instalaciones').val(datos.cantidad);
				$('#unidad_instalaciones').val(datos.unidad);
				$('#valor_nuevo_instalaciones').val(datos.valor_nuevo);
				$('#vida_util_instalaciones').val(datos.vida_util);
				$('#edad_instalaciones').val(datos.edad);
				$('#factor_edad_instalaciones').val(datos.factor_edad);
				$('#factor_conservacion_instalaciones').val(datos.factor_conservacion);
				$('#factor_resultante_instalaciones').val(datos.factor_resultante);
				$('#valor_neto_instalaciones').val(datos.valor_neto);
				$('#valor_parcial_instalaciones').val(datos.valor_parcial);

			}
		});
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAefTerrenos").submit(function () {
		$('#messagesModalFormAefTerrenos').empty().removeClass();
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
					$('#messagesModalFormAefTerrenos').addClass('alert').addClass('alert-success').append(datos.message);
					if ($('#ctrlAefTerrenos').val() === 'ins') {
						$('#formAefTerrenos :reset').click();
					}
					aefTerrenos.ajax.reload();
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAefTerrenos').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAefConstrucciones").submit(function () {
		$('#messagesModalFormAefConstrucciones').empty().removeClass();
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
					$('#messagesModalFormAefConstrucciones').addClass('alert').addClass('alert-success').append(datos.message);
					if ($('#ctrlAefConstrucciones').val() === 'ins') {
						$('#formAefConstrucciones :reset').click();
					}
					$('#valor_terreno').empty().append(datos.valor_terreno);
					aefConstrucciones.ajax.reload();
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAefConstrucciones').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAefCondominios").submit(function () {
		$('#messagesModalFormAefCondominios').empty().removeClass();
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
					$('#messagesModalFormAefCondominios').addClass('alert').addClass('alert-success').append(datos.message);
					if ($('#ctrlAefCondominios').val() === 'ins') {
						$('#formAefCondominios :reset').click();
					}
					aefCondominios.ajax.reload();
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAefCondominios').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAefInstalaciones").submit(function () {
		$('#messagesModalFormAefInstalaciones').empty().removeClass();
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
					$('#messagesModalFormAefInstalaciones').addClass('alert').addClass('alert-success').append(datos.message);
					if ($('#ctrlAefInstalaciones').val() === 'ins') {
						$('#formAefInstalaciones :reset').click();
					}
					aefInstalaciones.ajax.reload();
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAefInstalaciones').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

});
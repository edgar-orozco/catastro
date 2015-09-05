/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var aemCompTerrenos, aemHomologacion, aemInformacion, aemAnalisis;

$(document).ready(function () {
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btn3EnfoqueMercado').removeClass("btn-info").addClass("btn-primary");

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 *  
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	aemCompTerrenos = $('#aemCompTerrenosDataTable').DataTable();
	aemCompTerrenos.ajax.url('/corevat/AemCompTerrenosGetAjax/' + $("#idavaluoenfoquemercado").val()).load();

	aemHomologacion = $('#aemHomologacionDataTable').DataTable();
	aemHomologacion.ajax.url('/corevat/AemHomologacionGetAjax/' + $("#idavaluoenfoquemercado").val()).load();

	aemInformacion = $('#aemInformacionDataTable').DataTable();
	aemInformacion.ajax.url('/corevat/AemInformacionGetAjax/' + $("#idavaluoenfoquemercado").val()).load();

	aemAnalisis = $('#aemAnalisisDataTable').DataTable();
	aemAnalisis.ajax.url('/corevat/AemAnalisisGetAjax/' + $("#idavaluoenfoquemercado").val()).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAemComp').click(function () {
		$('#formAemCompTerrenos').trigger('reset');
		$('#messagesModalFormAemCompTerrenos').empty().removeClass();
		$('#ctrlAemCompTerrenos').val('ins');
		$('#idaemcompterreno').val('0');
		$('#modalFormAemCompTerrenosTitle').empty().append('[COREVAT] Nuevo Registro Comparable');
		$('#modalFormAemCompTerrenos').modal('show');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * PENDIENTE CACHAR ERRORES EN AJAX
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemCompTerrenos = function (id) {
		$('#messagesModalFormAemCompTerrenos').empty().removeClass();
		$('#ctrlAemCompTerrenos').val('upd');
		$('#idaemcompterreno').val(id);
		$.loadFormAemCompTerrenos(id);
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * PENDIENTE CACHAR ERRORES EN AJAX
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemHomologacion = function (id) {
		$('#messagesModalFormAemHomologacion').empty().removeClass();
		$('#ctrlAemHomologacion').val('upd');
		$('#idaemhomologacion').val(id);
		$.loadFormAemHomologacion(id);
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAemInf').click(function () {
		$('#formAemInformacion').trigger('reset');
		$('#messagesModalFormAemInformacion').empty().removeClass();
		$('#ctrlAemInformacion').val('ins');
		$('#idaeminformacion').val('0');
		$('#modalFormAemInformacionTitle').empty().append('[COREVAT] Nuevo Registro Comparable Mercado');
		$('#modalFormAemInformacion').modal('show');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemInformacion = function (id) {
		$('#messagesModalFormAemInformacion').empty().removeClass();
		$('#ctrlAemInformacion').val('upd');
		$('#idaeminformacion').val(id);
		$.loadFormAemInformacion(id);
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemAnalisis = function (id) {
		$('#messagesModalFormAemAnalisis').empty().removeClass();
		$('#idaemanalisis').val(id);
		$.loadFormAemAnalisis(id);
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAemCompTerrenos = function (id) {
		$('#corevatConfirmButton').attr('ctrl', 'delAemCompTerrenos').attr('idTable', id);
		$('#corevatConfirmContainer').empty().append('<h2>¿Realmente dese eliminar el registro?<h2>');
		$('#corevatConfirm').modal('show');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAemInformacion = function (id) {
		$('#corevatConfirmButton').attr('ctrl', 'delAemInformacion').attr('idTable', id);
		$('#corevatConfirmContainer').empty().append('<h2>¿Realmente dese eliminar el registro?<h2>');
		$('#corevatConfirm').modal('show');
	};

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemCompTerrenos = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AemCompTerrenosGet/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$('#ubicacion_aemcompterreno').val(datos.ubicacion);
				$('#precio').val(datos.precio);
				$('#superficie_terreno_aemcompterreno').val(datos.superficie_terreno);
				$('#precio_unitario_m2_terreno').val(datos.precio_unitario_m2_terreno);
				$('#observaciones_aemcompterreno').val(datos.observaciones);
				$('#modalFormAemCompTerrenosTitle').empty().append('[COREVAT] Modificar Registro Comparable');
				$('#modalFormAemCompTerrenos').modal('show');
			}
		});
    };

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.loadFormAemHomologacion = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AemHomologacionGet/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$('#comparable').val(datos.comparable);
				$('#superficie_terreno_aemhomologacion').val(datos.superficie_terreno);
				$('#valor_unitario').val(datos.valor_unitario);
				$('#zona_aemhomologacion').val(datos.zona);
				$('#ubicacion_aemhomologacion').val(datos.ubicacion);
				$('#frente').val(datos.frente);
				$('#forma').val(datos.forma);

				$("#idfactorzona_aemhomologacion option[value=" + datos.fk_zona + "]").attr("selected", true);
				$("#idfactorubicacion_aemhomologacion option[value=" + datos.fk_ubicacion + "]").attr("selected", true);
				$("#idfactorfrente option[value=" + datos.fk_frente + "]").attr("selected", true);
				$("#idfactorforma option[value=" + datos.fk_forma + "]").attr("selected", true);

				$('#superficie_aemhomologacion').val(datos.superficie);
				$('#valor_unitario_negociable').val(datos.valor_unitario_negociable);
				$('#valor_unitario_resultante_m2_aemhomologacion').val(datos.valor_unitario_resultante_m2);
				$('#in_promedio_aemhomologacion').prop('checked', (datos.in_promedio === 1 ? true : false));
				$('#modalFormAemHomologacionTitle').empty().append('[COREVAT] Homologable: ' + id);
				$('#modalFormAemHomologacion').modal('show');
			}
		});
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.loadFormAemInformacion = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AemInformacionGet/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$('#ubicacion_aeminformacion').val(datos.ubicacion);
				$('#edad').val(datos.edad);
				$('#telefono').val(datos.telefono);
				$('#observaciones_aeminformacion').val(datos.observaciones);
				$('#modalFormAemInformacionTitle').empty().append('[COREVAT] Modificar Registro Comparable Mercado: ' + id);
				$('#modalFormAemInformacion').modal('show');
			}
		});
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.loadFormAemAnalisis = function (id) {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AemAnalisisGet/' + id,
			type: 'get',
			success: function (data) {
				datos = eval(data);
				$('#precio_venta').val(datos.precio_venta);
				$('#superficie_terreno_aemanalisis').val(datos.superficie_terreno);
				$('#superficie_construccion_aemanalisis').val(datos.superficie_construccion);
				$('#valor_unitario_m2_aemanalisis').val(datos.valor_unitario_m2);

				$("#idfactorzona_aemanalisis option[value=" + datos.fk_zona + "]").attr("selected", true);
				$('#factor_zona').val(datos.factor_zona);

				$("#ubicacion_aemanalisis option[value=" + datos.fk_ubicacion + "]").attr("selected", true);
				$('#factor_ubicacion').val(datos.factor_ubicacion);

				$('#factor_superficie').val(datos.factor_superficie);
				$('#factor_edad').val(datos.factor_edad);

				$("#idfactorconservacion option[value=" + datos.idfactorconservacion + "]").attr("selected", true);
				$('#factor_conservacion').val(datos.factor_conservacion);

				$('#factor_negociacion').val(datos.factor_negociacion);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#valor_unitario_resultante_m2_aemanalisis').val(datos.valor_unitario_resultante_m2);
				
				$('#in_promedio_aemanalisis').prop('checked', (datos.in_promedio === 1 ? true : false));
				$('#modalFormAemAnalisisTitle').empty().append('[COREVAT] Homologable: ' + id);
				$('#modalFormAemAnalisis').modal('show');
			}
		});
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAemCompTerrenos").submit(function () {
		$('#messagesModalFormAemCompTerrenos').empty().removeClass();
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
					$('#messagesModalFormAemCompTerrenos').addClass('alert').addClass('alert-success').append(datos.message);
					if ($('#ctrlAemCompTerrenos').val() == 'ins') {
						$('#formAemCompTerrenos :reset').click();
					}
					$('#valor_unitario_promedio').empty().append(datos.valor_unitario_promedio);
					$('#valor_aplicado_m2').empty().append(datos.valor_aplicado_m2);
					aemCompTerrenos.ajax.reload();
					aemHomologacion.ajax.reload();
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAemCompTerrenos').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAemHomologacion").submit(function () {
		$('#messagesModalFormAemHomologacion').empty().removeClass();
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
					$('#messagesModalFormAemHomologacion').addClass('alert').addClass('alert-success').append(datos.message);
					aemHomologacion.ajax.reload();
					$('#valor_unitario_promedio').empty().append(datos.valor_unitario_promedio);
					$('#valor_aplicado_m2').empty().append(datos.valor_aplicado_m2);
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAemHomologacion').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAemInformacion").submit(function () {
		$('#messagesModalFormAemInformacion').empty().removeClass();
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
					$('#messagesModalFormAemInformacion').addClass('alert').addClass('alert-success').append(datos.message);
					if ($('#ctrlAemInformacion').val() == 'ins') {
						$('#formAemInformacion :reset').click();
					}
					aemInformacion.ajax.reload();
					aemAnalisis.ajax.reload()
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAemInformacion').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formAemAnalisis").submit(function () {
		$('#messagesModalFormAemAnalisis').empty().removeClass();
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
					$('#messagesModalFormAemAnalisis').addClass('alert').addClass('alert-success').append(datos.message);
					
					$('#valor_unitario_m2_aemanalisis').val(datos.valor_unitario_m2);
					$('#factor_superficie').val(datos.factor_superficie);
					$('#factor_resultante').val(datos.factor_resultante);
					$('#valor_unitario_resultante_m2_aemanalisis').val(datos.valor_unitario_resultante_m2);
					
					$('#promedio_analisis').empty().append(datos.promedio_analisis);
					$('#superficie_construida').empty().append(datos.superficie_construida);
					$('#valor_comparativo_mercado').empty().append(datos.valor_comparativo_mercado);
					
					aemAnalisis.ajax.reload();
				} else {
					var errores = '';
					for (datos in data.errors) {
						errores += '<p>' + data.errors[datos] + '</p>';
					}
					$('#messagesModalFormAemAnalisis').addClass('alert').addClass('alert-danger').append(errores);
				}
			}
		});
		return false;
	});
});

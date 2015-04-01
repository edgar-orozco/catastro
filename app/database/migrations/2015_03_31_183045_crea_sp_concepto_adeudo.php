<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaSpConceptoAdeudo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_get_concepto_adeudo'");
                if(count($existe) > 0) {

                	DB::statement("DROP FUNCTION  sp_get_concepto_adeudo( IN p_clave TEXT, IN gid_municipio INTEGER);");
									}
		$predios= <<<FinSP
CREATE OR REPLACE FUNCTION sp_get_concepto_adeudo(p_clave IN TEXT, gid_municipio IN INTEGER)
RETURNS TEXT AS
$$
DECLARE
	adeudo 				record;
	suma					REAL;
	v_inpc_actual REAL;
	v_anio			  integer;
	v_mes			    integer;
	v_inpc			  REAL;
	v_factor			REAL;
	v_actualizacion	REAL;
	v_total				REAL;
	v_impuesto_actual	REAL;
	v_ultimo_dia INTEGER;
	v_fecha_final DATE;
	v_fecha_inicial DATE;
	v_fecha_actual DATE;
	v_numero_meses INTEGER;
	v_porcentaje_recargo FLOAT;
	v_recargos REAL := 0;
	v_subtotal REAL := 0;
	v_gasto_ejecucion REAL :=0;
	v_gran_total REAL :=0;
	v_porcentaje_gasto INTEGER :=0;
	v_descuento_multa INTEGER :=0;
	v_descuento_gasto_ejecucion INTEGER :=0;
	v_descuento_recargo INTEGER :=0;
	v_descuento_gasto REAL :=0;
	v_descuento_recargos REAL :=0;
	v_total_vale REAL :=0;
	v_total_descuentos REAL :=0;


	-- Este cursor
  c_adeudos CURSOR FOR SELECT ep.clave
											 		  , TO_CHAR(ep.anio,'YYYY') anno
														, ep.ejercicio
														, ep.impuesto
												 FROM emision_predial ep
												WHERE ep.clave = p_clave
											  ORDER BY 2,3;
BEGIN
	-- Obtenemos el inpc actual aplicable
	SELECT TO_CHAR(current_date,'YYYY') into v_anio;
	SELECT TO_CHAR(current_date,'mm') into v_mes;
SELECT to_date('01/'||v_mes-1||'/'||v_anio, 'dd/mm/yyyy') into v_fecha_actual;

select extract (day from (select date_trunc('month', v_fecha_actual)
+ interval '1 month') - interval '1 day')INTO v_ultimo_dia;
select to_date(v_ultimo_dia||'/'||v_mes-1||'/'||v_anio, 'dd/mm/yyyy') into v_fecha_final;


	--v_inpc_actual :=0.0;

	SELECT ac.inpc
		INTO v_inpc_actual
		FROM inpc ac
	 WHERE ac.anio = v_anio
		 AND ac.mes = (v_mes-1);
--	v_inpc_actual :=110.00;
	v_total := 0;


	FOR adeudo IN c_adeudos LOOP
		-- Inicializamos las variables
			v_factor := 0;
			v_impuesto_actual := 0;
			v_actualizacion := 0;
			v_inpc :=0;

		IF adeudo.ejercicio = 1 then
	select TO_DATE('01/01/' || adeudo.anno, 'dd/mm/yyyy') into v_fecha_inicial;

			-- Buscamos indice del mes de mayo
				SELECT inpc.inpc
					INTO v_inpc
					FROM inpc
				 WHERE inpc.anio = to_number(adeudo.anno,'9999')
					 AND inpc.mes = 5; -- Mayo

		ELSIF adeudo.ejercicio = 2 then

			select TO_DATE('01/07/' || adeudo.anno, 'dd/mm/yyyy') into v_fecha_inicial;
			-- Buscamos inpc de noviembre

				SELECT inpc.inpc
					INTO v_inpc
					FROM inpc
				 WHERE inpc.anio = to_number(adeudo.anno,'9999')
					 AND inpc.mes = 11; -- noviembre
		ELSE
			v_inpc :=0;
		END IF;

		IF v_inpc > 0 THEN

		select (date_part('year', age) * 12) + date_part('month', age) INTO v_numero_meses
			from (select age(v_fecha_final::date, v_fecha_inicial::date)) foodate;
     --
			v_subtotal := v_subtotal + adeudo.impuesto;
			v_porcentaje_recargo := v_numero_meses * 2;
			v_factor := v_inpc_actual / v_inpc;
			v_impuesto_actual := v_factor * adeudo.impuesto;
			v_actualizacion := v_impuesto_actual - adeudo.impuesto;
			v_total := v_total + v_actualizacion;
			v_recargos := (v_recargos+((v_porcentaje_recargo * v_impuesto_actual)/100));

		END IF;

  END LOOP;

	-- Obtenemos el gasto de ejecucion del municipios
	select cm.gastos_ejecucion_porcentaje into v_porcentaje_gasto
 FROM configuracion_municipal cm WHERE cm.municipio = gid_municipio;
-- Obtenemos el gasto de ejecucion del municipios
	select cm.descuento_multa into v_descuento_multa
 FROM configuracion_municipal cm WHERE cm.municipio = gid_municipio;
	select cm.descuento_gasto_ejecucion into v_descuento_gasto_ejecucion
 FROM configuracion_municipal cm WHERE cm.municipio = gid_municipio;

-- Obtenemos el gasto de ejecucion del municipios
	select cm.descuento_recargo into v_descuento_recargo
 FROM configuracion_municipal cm WHERE cm.municipio = gid_municipio;

	v_gasto_ejecucion := (((v_subtotal +v_recargos + v_actualizacion) * v_porcentaje_gasto)/100);
	v_gran_total= v_subtotal + v_actualizacion +v_recargos + v_gasto_ejecucion;
	------------------------------------
	v_descuento_gasto:=	((v_gasto_ejecucion * v_descuento_gasto_ejecucion)/100);
  --v_descuento_multa:=(());
	v_descuento_recargos:=((v_recargos * v_descuento_recargo)/100);

	v_total_descuentos:= v_descuento_gasto+v_descuento_recargos;
	v_total_vale:= v_gran_total - v_total_descuentos;
	RETURN v_actualizacion||'-'||v_recargos||'-'||v_gasto_ejecucion||'-'||v_gran_total||'-'||v_descuento_multa||'-'||v_descuento_gasto_ejecucion||'-'||v_descuento_recargo||'-'||v_total_vale;

END;
$$
LANGUAGE plpgsql;
FinSP;
DB::connection()->getPdo()->exec($predios);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$sql = "DROP FUNCTION IF EXISTS sp_get_concepto_adeudo();";
		DB::connection()->getPdo()->exec($sql);
	}

}

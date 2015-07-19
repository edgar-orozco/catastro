<?php

class CorevatUpdateIRSeeder extends Seeder {

	public function run() {
		/*
			
		*/
		//DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_inmueble AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		//DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		//DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_enfoque_mercado AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		//DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_fotos_planos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		//DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_conclusiones AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS update_ir();");
		
$sql = <<<FinSP
CREATE OR REPLACE FUNCTION update_ir() RETURNS void AS $$
DECLARE
	v_row1 RECORD;
	v_row2 RECORD;
	v_row_avaluo RECORD;
	v_row_seq RECORD;
BEGIN
	-- avaluos VS avaluo_zona
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_zona AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			INSERT INTO avaluo_zona (idavaluo, idclasificacionzona, idproximidadurbana, construc_predominante, vias_acceso_importante) 
			VALUES(v_row1.idavaluo, 1, 1, '', '');
		END IF;
	END LOOP;
	-- avaluo_zona VS avaluos
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluo_zona AS a LEFT JOIN avaluos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			DELETE FROM avaluo_zona WHERE idavaluo = v_row1.idavaluo;
		END IF;
	END LOOP;
	
	-- avaluos VS avaluo_inmueble
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_inmueble AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			INSERT INTO avaluo_inmueble (idavaluo, croquis, fachada, medidas_colindancias, servidumbre_restricciones, descripcion_inmueble,
			cimentacion, estructura, muros, entrepisos, techos, bardas, recamaras0, recamaras1, recamaras2, 
			estancia_comedor0, estancia_comedor1, estancia_comedor2, banos0, banos1, banos2, escaleras0, escaleras1, escaleras2,
			cocina0, cocina1, cocina2, patio_servicio0, patio_servicio1, patio_servicio2, estacionamiento0, estacionamiento1, estacionamiento2, 
			fachada0, fachada1, fachada2, hidraulico_sanitarias, electricas, carpinteria, herreria,
			id_cimentacion, id_estructura, id_muro, id_entrepiso, id_techo, id_barda, idusossuelo) 
			VALUES(v_row1.idavaluo, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 
			'', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 24, 28, 30, 8, 45, 9, 12);
		END IF;
	END LOOP;
	-- avaluo_inmueble VS avaluos
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluo_inmueble AS a LEFT JOIN avaluos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			DELETE FROM avaluo_inmueble WHERE idavaluo = v_row1.idavaluo;
		END IF;
	END LOOP;
	-- ai_medidas_colindancias VS avaluo_inmueble
	FOR v_row1 IN SELECT a.idavaluoinmueble, b.idavaluoinmueble AS idavaluoinmueble1 FROM ai_medidas_colindancias AS a LEFT JOIN avaluo_inmueble AS b ON a.idavaluoinmueble = b.idavaluoinmueble ORDER BY a.idavaluoinmueble LOOP
		IF v_row1.idavaluoinmueble1 IS NULL THEN
			DELETE FROM ai_medidas_colindancias WHERE idavaluoinmueble = v_row1.idavaluoinmueble;
		END IF;
	END LOOP;
	
	-- avaluos VS avaluo_enfoque_mercado
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_enfoque_mercado AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			INSERT INTO avaluo_enfoque_mercado (idavaluo) VALUES(v_row1.idavaluo);
		END IF;
	END LOOP;
	-- avaluo_enfoque_mercado VS avaluos
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluo_enfoque_mercado AS a LEFT JOIN avaluos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			DELETE FROM avaluo_enfoque_mercado WHERE idavaluo = v_row1.idavaluo;
		END IF;
	END LOOP;
	-- aem_comp_terrenos VS avaluo_enfoque_mercado
	FOR v_row1 IN SELECT a.idavaluoenfoquemercado, b.idavaluoenfoquemercado AS idavaluoenfoquemercado1 FROM aem_comp_terrenos AS a LEFT JOIN avaluo_enfoque_mercado AS b ON a.idavaluoenfoquemercado = b.idavaluoenfoquemercado ORDER BY a.idavaluoenfoquemercado LOOP
		IF v_row1.idavaluoenfoquemercado1 IS NULL THEN
			DELETE FROM aem_comp_terrenos WHERE idavaluoenfoquemercado = v_row1.idavaluoenfoquemercado;
		END IF;
	END LOOP;
	
	-- aem_comp_terrenos VS aem_homologacion
	
	-- aem_homologacion VS aem_comp_terrenos
	FOR v_row1 IN SELECT a.idaemcompterreno, b.idaemcompterreno AS idaemcompterreno1 FROM aem_homologacion AS a LEFT JOIN aem_comp_terrenos AS b ON a.idaemcompterreno = b.idaemcompterreno ORDER BY a.idaemcompterreno LOOP
		IF v_row1.idaemcompterreno1 IS NULL THEN
			DELETE FROM aem_homologacion WHERE idaemcompterreno = v_row1.idaemcompterreno;
		END IF;
	END LOOP;
	-- aem_informacion VS avaluo_enfoque_mercado
	FOR v_row1 IN SELECT a.idavaluoenfoquemercado, b.idavaluoenfoquemercado AS idavaluoenfoquemercado1 FROM aem_informacion AS a LEFT JOIN avaluo_enfoque_mercado AS b ON a.idavaluoenfoquemercado = b.idavaluoenfoquemercado ORDER BY a.idavaluoenfoquemercado LOOP
		IF v_row1.idavaluoenfoquemercado1 IS NULL THEN
			DELETE FROM aem_informacion WHERE idavaluoenfoquemercado = v_row1.idavaluoenfoquemercado;
		END IF;
	END LOOP;
	-- aem_analisis VS aem_informacion
	FOR v_row1 IN SELECT a.idaeminformacion, b.idaeminformacion AS idaeminformacion1 FROM aem_analisis AS a LEFT JOIN aem_informacion AS b ON a.idaeminformacion = b.idaeminformacion ORDER BY a.idaeminformacion LOOP
		IF v_row1.idaeminformacion1 IS NULL THEN
			DELETE FROM aem_homologacion WHERE idaeminformacion = v_row1.idaeminformacion;
		END IF;
	END LOOP;
	
	-- avaluos VS avaluo_enfoque_fisico
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			INSERT INTO avaluo_enfoque_fisico (idavaluo, idclasegeneral, idtipoinmueble, idestado_conservacion, idcalidadproyecto, 
			edad_construccion, vida_util, numero_niveles, nivel_edificio_condominio) 
			VALUES(v_row1.idavaluo, 1, 1, 1, 1, 0, 0, 0, 0);
		END IF;
	END LOOP;
	-- avaluo_enfoque_fisico VS avaluos
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluo_enfoque_fisico AS a LEFT JOIN avaluos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			DELETE FROM avaluo_enfoque_fisico WHERE idavaluo = v_row1.idavaluo;
		END IF;
	END LOOP;
	-- aef_terrenos VS avaluo_enfoque_fisico
	FOR v_row1 IN SELECT a.idavaluoenfoquefisico, b.idavaluoenfoquefisico AS idavaluoenfoquefisico1 FROM aef_terrenos AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluoenfoquefisico = b.idavaluoenfoquefisico ORDER BY a.idavaluoenfoquefisico LOOP
		IF v_row1.idavaluoenfoquefisico1 IS NULL THEN
			DELETE FROM aef_terrenos WHERE idavaluoenfoquefisico = v_row1.idavaluoenfoquefisico;
		END IF;
	END LOOP;
	-- aef_construcciones VS avaluo_enfoque_fisico
	FOR v_row1 IN SELECT a.idavaluoenfoquefisico, b.idavaluoenfoquefisico AS idavaluoenfoquefisico1 FROM aef_construcciones AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluoenfoquefisico = b.idavaluoenfoquefisico ORDER BY a.idavaluoenfoquefisico LOOP
		IF v_row1.idavaluoenfoquefisico1 IS NULL THEN
			DELETE FROM aef_construcciones WHERE idavaluoenfoquefisico = v_row1.idavaluoenfoquefisico;
		END IF;
	END LOOP;
	-- aef_condominios VS avaluo_enfoque_fisico
	FOR v_row1 IN SELECT a.idavaluoenfoquefisico, b.idavaluoenfoquefisico AS idavaluoenfoquefisico1 FROM aef_condominios AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluoenfoquefisico = b.idavaluoenfoquefisico ORDER BY a.idavaluoenfoquefisico LOOP
		IF v_row1.idavaluoenfoquefisico1 IS NULL THEN
			DELETE FROM aef_condominios WHERE idavaluoenfoquefisico = v_row1.idavaluoenfoquefisico;
		END IF;
	END LOOP;
	-- aef_comp_construcciones VS avaluo_enfoque_fisico
	FOR v_row1 IN SELECT a.idavaluoenfoquefisico, b.idavaluoenfoquefisico AS idavaluoenfoquefisico1 FROM aef_comp_construcciones AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluoenfoquefisico = b.idavaluoenfoquefisico ORDER BY a.idavaluoenfoquefisico LOOP
		IF v_row1.idavaluoenfoquefisico1 IS NULL THEN
			DELETE FROM aef_comp_construcciones WHERE idavaluoenfoquefisico = v_row1.idavaluoenfoquefisico;
		END IF;
	END LOOP;
	-- aef_instalaciones VS avaluo_enfoque_fisico
	FOR v_row1 IN SELECT a.idavaluoenfoquefisico, b.idavaluoenfoquefisico AS idavaluoenfoquefisico1 FROM aef_instalaciones AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluoenfoquefisico = b.idavaluoenfoquefisico ORDER BY a.idavaluoenfoquefisico LOOP
		IF v_row1.idavaluoenfoquefisico1 IS NULL THEN
			DELETE FROM aef_instalaciones WHERE idavaluoenfoquefisico = v_row1.idavaluoenfoquefisico;
		END IF;
	END LOOP;
	
	-- avaluos VS avaluo_fotos_planos
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_fotos_planos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			INSERT INTO avaluo_fotos_planos (idavaluo) VALUES(v_row1.idavaluo);
		END IF;
	END LOOP;
	-- avaluo_fotos_planos VS avaluos
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluo_fotos_planos AS a LEFT JOIN avaluos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			DELETE FROM avaluo_fotos_planos WHERE idavaluo = v_row1.idavaluo;
		END IF;
	END LOOP;
	
	-- avaluos VS avaluo_conclusiones
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_conclusiones AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			INSERT INTO avaluo_conclusiones (idavaluo, leyenda, sello, firma) 
			VALUES(v_row1.idavaluo, '', '', '');
		END IF;
	END LOOP;
	-- avaluo_conclusiones VS avaluos
	FOR v_row1 IN SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluo_conclusiones AS a LEFT JOIN avaluos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo LOOP
		IF v_row1.idavaluo1 IS NULL THEN
			DELETE FROM avaluo_conclusiones WHERE idavaluo = v_row1.idavaluo;
		END IF;
	END LOOP;
	
	--DROP VIEW IF EXISTS v01_corevat;
END;
$$ LANGUAGE plpgsql;
FinSP;
		DB::connection('corevat')->getPdo()->exec($sql);
		
		#EJECUTAMOS LA FUNCION
		DB::connection('corevat')->getPdo()->exec("SELECT update_ir();");
		
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS update_ir();");
		
	}

}

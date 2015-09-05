<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatModifyDbVariousConstraints extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

ALTER TABLE avaluo_zona             DROP CONSTRAINT avaluo_zona_idavaluo_foreign;
ALTER TABLE avaluo_inmueble         DROP CONSTRAINT avaluo_inmueble_idavaluo_foreign;
ALTER TABLE avaluo_enfoque_mercado  DROP CONSTRAINT avaluo_enfoque_mercado_idavaluo_foreign;
ALTER TABLE avaluo_enfoque_fisico   DROP CONSTRAINT avaluo_enfoque_fisico_idavaluo_foreign;
ALTER TABLE avaluo_conclusiones     DROP CONSTRAINT avaluo_conclusiones_idavaluo_foreign;
ALTER TABLE avaluo_fotos_planos     DROP CONSTRAINT avaluo_fotos_planos_idavaluo_foreign;

ALTER TABLE avaluos DROP CONSTRAINT avaluos_idemp_foreign;

--
ALTER TABLE ai_medidas_colindancias DROP CONSTRAINT ai_medidas_colindancias_idavaluoinmueble_foreign;

--
ALTER TABLE aem_comp_terrenos DROP CONSTRAINT aem_comp_terrenos_idavaluoenfoquemercado_foreign;
ALTER TABLE aem_comp_terrenos DROP CONSTRAINT aem_comp_terrenos_idemp_foreign;
ALTER TABLE aem_homologacion DROP CONSTRAINT aem_homologacion_idaemcompterreno_foreign;
ALTER TABLE aem_homologacion DROP CONSTRAINT aem_homologacion_idavaluoenfoquemercado_foreign;
ALTER TABLE aem_homologacion DROP CONSTRAINT aem_homologacion_idemp_foreign;
ALTER TABLE aem_analisis DROP CONSTRAINT aem_analisis_idaeminformacion_foreign;
ALTER TABLE aem_analisis DROP CONSTRAINT aem_analisis_idemp_foreign;
ALTER TABLE aem_analisis DROP CONSTRAINT aem_analisis_idavaluoenfoquemercado_foreign;
ALTER TABLE aem_informacion DROP CONSTRAINT aem_informacion_idavaluoenfoquemercado_foreign;
ALTER TABLE aem_informacion DROP CONSTRAINT aem_informacion_idemp_foreign;

ALTER TABLE aef_comp_construcciones DROP CONSTRAINT aef_comp_construcciones_idemp_foreign;
ALTER TABLE aef_condominios DROP CONSTRAINT aef_condominios_idavaluoenfoquefisico_foreign;
ALTER TABLE aef_condominios DROP CONSTRAINT aef_condominios_idemp_foreign;
ALTER TABLE aef_construcciones DROP CONSTRAINT aef_construcciones_idavaluoenfoquefisico_foreign;
ALTER TABLE aef_construcciones DROP CONSTRAINT aef_construcciones_idemp_foreign;
ALTER TABLE aef_instalaciones DROP CONSTRAINT aef_instalaciones_idavaluoenfoquefisico_foreign;
ALTER TABLE aef_instalaciones DROP CONSTRAINT aef_instalaciones_idemp_foreign;
ALTER TABLE aef_terrenos DROP CONSTRAINT aef_terrenos_idavaluoenfoquefisico_foreign;
ALTER TABLE aef_terrenos DROP CONSTRAINT aef_terrenos_idemp_foreign;

-- 
ALTER TABLE avaluo_zona            ADD FOREIGN KEY (idavaluo) REFERENCES avaluos (idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE avaluo_inmueble        ADD FOREIGN KEY (idavaluo) REFERENCES avaluos (idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE avaluo_enfoque_mercado ADD FOREIGN KEY (idavaluo) REFERENCES avaluos (idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE avaluo_enfoque_fisico  ADD FOREIGN KEY (idavaluo) REFERENCES avaluos (idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE avaluo_conclusiones    ADD FOREIGN KEY (idavaluo) REFERENCES avaluos (idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE avaluo_fotos_planos    ADD FOREIGN KEY (idavaluo) REFERENCES avaluos (idavaluo) ON DELETE CASCADE ON UPDATE CASCADE;

--
ALTER TABLE ai_medidas_colindancias ADD FOREIGN KEY (idavaluoinmueble) REFERENCES avaluo_inmueble (idavaluoinmueble) ON DELETE CASCADE ON UPDATE CASCADE;

--
ALTER TABLE aem_comp_terrenos ADD FOREIGN KEY (idavaluoenfoquemercado) REFERENCES avaluo_enfoque_mercado (idavaluoenfoquemercado) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE aem_homologacion ADD FOREIGN KEY (idaemcompterreno) REFERENCES aem_comp_terrenos (idaemcompterreno) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE aem_informacion ADD FOREIGN KEY (idavaluoenfoquemercado) REFERENCES avaluo_enfoque_mercado (idavaluoenfoquemercado) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE aem_analisis ADD FOREIGN KEY (idaeminformacion) REFERENCES aem_informacion (idaeminformacion) ON DELETE CASCADE ON UPDATE CASCADE;

--
ALTER TABLE aef_construcciones ADD FOREIGN KEY (idavaluoenfoquefisico) REFERENCES avaluo_enfoque_fisico (idavaluoenfoquefisico) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE aef_terrenos ADD FOREIGN KEY (idavaluoenfoquefisico) REFERENCES avaluo_enfoque_fisico (idavaluoenfoquefisico) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE aef_condominios ADD FOREIGN KEY (idavaluoenfoquefisico) REFERENCES avaluo_enfoque_fisico (idavaluoenfoquefisico) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE aef_instalaciones ADD FOREIGN KEY (idavaluoenfoquefisico) REFERENCES avaluo_enfoque_fisico (idavaluoenfoquefisico) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE aef_comp_construcciones ADD FOREIGN KEY (idavaluoenfoquefisico) REFERENCES avaluo_enfoque_fisico (idavaluoenfoquefisico) ON DELETE CASCADE ON UPDATE CASCADE;


-- **************************************************************************************************************************************************************************
--
ALTER TABLE avaluo_zona ALTER COLUMN construc_predominante SET DEFAULT '';
ALTER TABLE avaluo_zona ALTER COLUMN vias_acceso_importante SET DEFAULT '';
ALTER TABLE avaluo_zona ALTER COLUMN idclasificacionzona SET DEFAULT 1;
ALTER TABLE avaluo_zona ALTER COLUMN idproximidadurbana SET DEFAULT 1;

--
ALTER TABLE avaluo_inmueble ALTER COLUMN croquis SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN fachada SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN medidas_colindancias SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN servidumbre_restricciones SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN descripcion_inmueble SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN cimentacion SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN estructura SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN muros SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN entrepisos SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN techos SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN bardas SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN recamaras0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN recamaras1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN recamaras2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN estancia_comedor0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN estancia_comedor1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN estancia_comedor2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN banos0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN banos1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN banos2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN escaleras0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN escaleras1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN escaleras2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN cocina0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN cocina1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN cocina2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN patio_servicio0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN patio_servicio1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN patio_servicio2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN estacionamiento0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN estacionamiento1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN estacionamiento2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN fachada0 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN fachada1 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN fachada2 SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN hidraulico_sanitarias SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN electricas SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN carpinteria SET DEFAULT '';
ALTER TABLE avaluo_inmueble ALTER COLUMN herreria SET DEFAULT '';

ALTER TABLE avaluo_inmueble ADD COLUMN edad_construccion INTEGER NOT NULL DEFAULT 0;

-- POR INTEGRIDAD REFERENCIAL
ALTER TABLE avaluo_inmueble ALTER COLUMN id_cimentacion SET DEFAULT 1;
ALTER TABLE avaluo_inmueble ALTER COLUMN id_estructura SET DEFAULT 1;
ALTER TABLE avaluo_inmueble ALTER COLUMN id_muro SET DEFAULT 1;
ALTER TABLE avaluo_inmueble ALTER COLUMN id_entrepiso SET DEFAULT 1;
ALTER TABLE avaluo_inmueble ALTER COLUMN id_techo SET DEFAULT 1;
ALTER TABLE avaluo_inmueble ALTER COLUMN id_barda SET DEFAULT 1;
ALTER TABLE avaluo_inmueble ALTER COLUMN idusossuelo SET DEFAULT 1;

ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN edad_construccion SET DEFAULT 0;
ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN vida_util SET DEFAULT 0;
ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN numero_niveles SET DEFAULT 0;
ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN nivel_edificio_condominio SET DEFAULT 0;

-- POR INTEGRIDAD REFERENCIAL
ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN idclasegeneral SET DEFAULT 1;
ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN idtipoinmueble SET DEFAULT 1;
ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN idestado_conservacion SET DEFAULT 1;
ALTER TABLE avaluo_enfoque_fisico ALTER COLUMN idcalidadproyecto SET DEFAULT 1;

--
ALTER TABLE avaluo_conclusiones ALTER COLUMN leyenda SET DEFAULT '';
ALTER TABLE avaluo_conclusiones ALTER COLUMN sello SET DEFAULT '';
ALTER TABLE avaluo_conclusiones ALTER COLUMN firma SET DEFAULT '';

-- **************************************************************************************************************************************************************************
--
-- **************************************************************************************************************************************************************************
ALTER TABLE avaluos DROP COLUMN IF EXISTS idemp;
ALTER TABLE avaluos DROP COLUMN IF EXISTS ip;
ALTER TABLE avaluos DROP COLUMN IF EXISTS host;
ALTER TABLE avaluos DROP COLUMN IF EXISTS creado_por;
ALTER TABLE avaluos DROP COLUMN IF EXISTS creado_el;
ALTER TABLE avaluos DROP COLUMN IF EXISTS modi_por;
ALTER TABLE avaluos DROP COLUMN IF EXISTS modi_el;
ALTER TABLE avaluos ADD COLUMN created_at TIMESTAMP;
ALTER TABLE avaluos ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE avaluos ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE avaluo_zona DROP COLUMN IF EXISTS idemp;
ALTER TABLE avaluo_zona DROP COLUMN IF EXISTS ip;
ALTER TABLE avaluo_zona DROP COLUMN IF EXISTS host;
ALTER TABLE avaluo_zona DROP COLUMN IF EXISTS creado_por;
ALTER TABLE avaluo_zona DROP COLUMN IF EXISTS creado_el;
ALTER TABLE avaluo_zona DROP COLUMN IF EXISTS modi_por;
ALTER TABLE avaluo_zona DROP COLUMN IF EXISTS modi_el;
ALTER TABLE avaluo_zona ADD COLUMN created_at TIMESTAMP;
ALTER TABLE avaluo_zona ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE avaluo_zona ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE avaluo_inmueble DROP COLUMN IF EXISTS idemp;
ALTER TABLE avaluo_inmueble DROP COLUMN IF EXISTS ip;
ALTER TABLE avaluo_inmueble DROP COLUMN IF EXISTS host;
ALTER TABLE avaluo_inmueble DROP COLUMN IF EXISTS creado_por;
ALTER TABLE avaluo_inmueble DROP COLUMN IF EXISTS creado_el;
ALTER TABLE avaluo_inmueble DROP COLUMN IF EXISTS modi_por;
ALTER TABLE avaluo_inmueble DROP COLUMN IF EXISTS modi_el;
ALTER TABLE avaluo_inmueble ADD COLUMN created_at TIMESTAMP;
ALTER TABLE avaluo_inmueble ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE avaluo_inmueble ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE ai_medidas_colindancias DROP COLUMN IF EXISTS idemp;
ALTER TABLE ai_medidas_colindancias DROP COLUMN IF EXISTS ip;
ALTER TABLE ai_medidas_colindancias DROP COLUMN IF EXISTS host;
ALTER TABLE ai_medidas_colindancias DROP COLUMN IF EXISTS creado_por;
ALTER TABLE ai_medidas_colindancias DROP COLUMN IF EXISTS creado_el;
ALTER TABLE ai_medidas_colindancias DROP COLUMN IF EXISTS modi_por;
ALTER TABLE ai_medidas_colindancias DROP COLUMN IF EXISTS modi_el;
ALTER TABLE ai_medidas_colindancias ADD COLUMN created_at TIMESTAMP;
ALTER TABLE ai_medidas_colindancias ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE ai_medidas_colindancias ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE avaluo_enfoque_mercado DROP COLUMN IF EXISTS idemp;
ALTER TABLE avaluo_enfoque_mercado DROP COLUMN IF EXISTS ip;
ALTER TABLE avaluo_enfoque_mercado DROP COLUMN IF EXISTS host;
ALTER TABLE avaluo_enfoque_mercado DROP COLUMN IF EXISTS creado_por;
ALTER TABLE avaluo_enfoque_mercado DROP COLUMN IF EXISTS creado_el;
ALTER TABLE avaluo_enfoque_mercado DROP COLUMN IF EXISTS modi_por;
ALTER TABLE avaluo_enfoque_mercado DROP COLUMN IF EXISTS modi_el;
ALTER TABLE avaluo_enfoque_mercado ADD COLUMN created_at TIMESTAMP;
ALTER TABLE avaluo_enfoque_mercado ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE avaluo_enfoque_mercado ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aem_comp_terrenos DROP COLUMN IF EXISTS idemp;
ALTER TABLE aem_comp_terrenos DROP COLUMN IF EXISTS ip;
ALTER TABLE aem_comp_terrenos DROP COLUMN IF EXISTS host;
ALTER TABLE aem_comp_terrenos DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aem_comp_terrenos DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aem_comp_terrenos DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aem_comp_terrenos DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aem_comp_terrenos ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aem_comp_terrenos ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aem_comp_terrenos ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aem_homologacion DROP COLUMN IF EXISTS idemp;
ALTER TABLE aem_homologacion DROP COLUMN IF EXISTS ip;
ALTER TABLE aem_homologacion DROP COLUMN IF EXISTS host;
ALTER TABLE aem_homologacion DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aem_homologacion DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aem_homologacion DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aem_homologacion DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aem_homologacion ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aem_homologacion ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aem_homologacion ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aem_informacion DROP COLUMN IF EXISTS idemp;
ALTER TABLE aem_informacion DROP COLUMN IF EXISTS ip;
ALTER TABLE aem_informacion DROP COLUMN IF EXISTS host;
ALTER TABLE aem_informacion DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aem_informacion DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aem_informacion DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aem_informacion DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aem_informacion ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aem_informacion ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aem_informacion ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aem_analisis DROP COLUMN IF EXISTS idemp;
ALTER TABLE aem_analisis DROP COLUMN IF EXISTS ip;
ALTER TABLE aem_analisis DROP COLUMN IF EXISTS host;
ALTER TABLE aem_analisis DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aem_analisis DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aem_analisis DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aem_analisis DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aem_analisis ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aem_analisis ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aem_analisis ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aef_terrenos DROP COLUMN IF EXISTS idemp;
ALTER TABLE aef_terrenos DROP COLUMN IF EXISTS ip;
ALTER TABLE aef_terrenos DROP COLUMN IF EXISTS host;
ALTER TABLE aef_terrenos DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aef_terrenos DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aef_terrenos DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aef_terrenos DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aef_terrenos ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aef_terrenos ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aef_terrenos ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aef_construcciones DROP COLUMN IF EXISTS idemp;
ALTER TABLE aef_construcciones DROP COLUMN IF EXISTS ip;
ALTER TABLE aef_construcciones DROP COLUMN IF EXISTS host;
ALTER TABLE aef_construcciones DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aef_construcciones DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aef_construcciones DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aef_construcciones DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aef_construcciones ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aef_construcciones ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aef_construcciones ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aef_condominios DROP COLUMN IF EXISTS idemp;
ALTER TABLE aef_condominios DROP COLUMN IF EXISTS ip;
ALTER TABLE aef_condominios DROP COLUMN IF EXISTS host;
ALTER TABLE aef_condominios DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aef_condominios DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aef_condominios DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aef_condominios DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aef_condominios ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aef_condominios ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aef_condominios ADD COLUMN updated_at TIMESTAMP;

ALTER TABLE aef_instalaciones DROP COLUMN IF EXISTS idemp;
ALTER TABLE aef_instalaciones DROP COLUMN IF EXISTS ip;
ALTER TABLE aef_instalaciones DROP COLUMN IF EXISTS host;
ALTER TABLE aef_instalaciones DROP COLUMN IF EXISTS creado_por;
ALTER TABLE aef_instalaciones DROP COLUMN IF EXISTS creado_el;
ALTER TABLE aef_instalaciones DROP COLUMN IF EXISTS modi_por;
ALTER TABLE aef_instalaciones DROP COLUMN IF EXISTS modi_el;
ALTER TABLE aef_instalaciones ADD COLUMN created_at TIMESTAMP;
ALTER TABLE aef_instalaciones ALTER COLUMN created_at SET DEFAULT now();
ALTER TABLE aef_instalaciones ADD COLUMN updated_at TIMESTAMP;

UPDATE cat_regimen_propiedad SET regimen_propiedad = 'Público Federal' WHERE idregimenpropiedad = 5;
UPDATE cat_regimen_propiedad SET regimen_propiedad = 'Público Estatal' WHERE idregimenpropiedad = 6;


EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	}

}

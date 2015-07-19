<?php

class CorevatUpdateIRSeeder extends Seeder {

	public function run() {
		/*
			CREAMOS 5 VISTAS PARA LAS RELACIONES:
				avaluos ==> avaluo_inmueble
				avaluos ==> avaluo_enfoque_fisico
				avaluos ==> avaluo_enfoque_mercado
				avaluos ==> avaluo_fotos_planos
				avaluos ==> avaluo_conclusiones
			
		*/
		DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_inmueble AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_enfoque_fisico AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_enfoque_mercado AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_fotos_planos AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		DB::connection('corevat')->getPdo()->exec("CREATE VIEW v01_corevat AS (SELECT a.idavaluo, b.idavaluo AS idavaluo1 FROM avaluos AS a LEFT JOIN avaluo_conclusiones AS b ON a.idavaluo = b.idavaluo ORDER BY a.idavaluo);");
		
		$sql = <<<FinSP
CREATE FUNCTION sp_get_predios (
);
		FinSP;
		
		
		
		
		
		// ELIMINAMOS LAS VISTAS
		
		//DB::connection('corevat')->table('avaluos')->delete();
		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluos_idavaluo_seq RESTART;");
		//DB::connection('corevat')->statement("COPY avaluos FROM '" . base_path() . "/sources/avaluos.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluos_idavaluo_seq START WITH 1;");
		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluos_idavaluo_seq RESTART WITH 510;");
	}

}

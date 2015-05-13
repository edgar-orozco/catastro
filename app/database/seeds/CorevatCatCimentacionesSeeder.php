<?php

class CorevatCatCimentacionesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_cimentaciones')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_cimentaciones_idcimentacion_seq RESTART;");
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'ADECUADA, EN GENERAL NO SE OBSERVAN ASENTAMIENTOS NI GRIETAS APARENTES'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'MAMPOSTERIA DE PIEDRA BOLA CON REFUERZOS DE CONCRETO'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'ZAPATAS AISLADAS Y CADENAS DE LIGA DE CONCRETO ARMADO, CLAROS CORTOS'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'ZAPATAS AISLADAS Y CADENAS DE LIGA DE CONCRETO ARMADO, CLAROS MEDIANOS.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'ZAPATAS CORRIDAS Y DALAS DE CIMENTACION DE CONCRETO, CLAROS GRANDES.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'LOSA CORRIDA DE CIMENTACION Y CONTRATRABES DE CONCRETO, CLAROS GRANDES.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'LOSA CORRIDA DE CIMENTACION Y CONTRATRABES DE CONCRETO, CLAROS CORTOS.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'PILOTES DE PUNTA O DE FRICCION CON CAPITELES Y CONTRATRABES, CLAROS GRANDES.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'ZAPATAS CORRIDAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'ZAPATAS CORRIDAS Y AISLADAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'ZAPATAS CORRIDAS DE CONCRETO ARMADO CON, FC=150 KG/CM².'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'APARENTE PIEDRA BRAZA MAMPOSTEADA CON CEMENTO, ARENA Y REFORZADA CON DALA DE REPARTICIÓN DE CONCRETO'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'APARENTE PIEDRA BRAZA MAMPOSTEADA DE 20X40X60 CMS, CON CEMENTO, ARENA Y REFORZADA CON DALA DE REPART'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'APARENTE ZAPATAS CORRIDAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'APARENTE ZAPATAS CORRIDAS Y AISLADAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'APARENTE ZAPATAS CORRIDAS DE CONCRETO ARMADO CON, FC=150 KG/CM².'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'APARENTE LOSA DE CIMENTACIÓN DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'APARENTE LOSA DE CIMENTACIÓN DE CONCRETO ARMADO, FC=150 KG/CM².'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'PROBABLE ZAPATAS CORRIDAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'PROBABLE ZAPATAS CORRIDAS Y AISLADAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'PROBABLE ZAPATAS CORRIDAS DE CONCRETO ARMADO CON, FC=150 KG/CM².'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'PROBABLE PIEDRA BRAZA MAMPOSTEADA CON CEMENTO, ARENA Y REFORZADA CON DALA DE REPARTICIÓN DE CONCRETO'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'PROBABLE PIEDRA BRAZA MAMPOSTEADA DE 20X40X60 CMS, CON CEMENTO, ARENA Y REFORZADA CON DALA DE REPART'));
		DB::connection('corevat')->table('cat_cimentaciones')->insert(array('cimentacion' => 'NO APLICA'));
	}
	
}





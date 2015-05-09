<?php

class CorevatCatEstructurasSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_estructuras')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_estructuras_idestructura_seq RESTART;");
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MIXTA; MUROS DE CARGA CON REFUERZOS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'DE CONCRETO REFORZADO'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MIXTA; MUROS DE CARGA, TRABES Y COLUMNAS DE CONCRETO REFORZADO'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'A BASE DE COLUMNAS Y TRABES DE CONCRETO REFORZADO'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'ESTRUCTURA ANGULAR DE GRAN CLARO, SOBRE MUROS LATERALES'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'ESTRUCTURA DE MONTEN Y COLUMNAS DE CONCRETO, PLACAS Y TENSORES'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'ARCO DE FLECHA DE GRAN CLARO, SOBRE MUROS LATERALES.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'VIGAS DE MADERA CEPILLADAS Y CINTAS DE MADERA DE CEDRO'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'DE MADERA ROLLIZA Y ARTESON CON HORCONES DE MADERA DURA.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE CARGA, DALAS Y CASTILLOS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE CARGA, CON TRABES Y COLUMNAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE CARGA, CON REFUERZOS VERTICALES Y HORIZONTALES, TRABES, Y COLUMNAS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE CARGA, DALAS Y CASTILLOS DE CONCRETO ARMADO TIPO ARMEX DE 15X20X4 CMS. Y LOSAS DE CONCRETO'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE CARGA, CON PERFILES METÁLICOS.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE CARGA DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE COVINTEC, CON DALAS Y CASTILLOS DE CONCRETO  ARMADO .'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MUROS DE COVINTEC.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS DE CONCRETO ARMADO CON VIGAS METÁLICAS.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS METÁLICOS A BASE DE PERFILES METÁLICOS, ELECTRO SOLDADO'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS METÁLICOS A BASE DE PERFILES METÁLICOS, REMACHADO'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS METÁLICOS A BASE DE PERFILES METÁLICOS, ANCLADO (PERNOS Y TORNILLOS)'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS RÍGIDOS DE ACERO ESTRUCTURAL CON COLUMNAS Y TRABES DE ACERO ESTRUCTURAL.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS RÍGIDOS A BASE DE COLUMNAS Y TRABES DE CONCRETO ARMADO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MARCOS DE ACERO ESTRUCTURAL CON VIGAS TIPO MONTEN PARA RECIBIR TECHO.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MIXTA, COLUMNAS DE CONCRETO ARMADO Y PERFILES METÁLICOS.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'MIXTA, COLUMNAS DE CONCRETO ARMADO Y VIGAS DE MADERA.'));
		DB::connection('corevat')->table('cat_estructuras')->insert(array('estructura' => 'NO APLICA'));
	}

}

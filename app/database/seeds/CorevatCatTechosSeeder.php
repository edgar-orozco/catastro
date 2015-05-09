<?php

class CorevatCatTechosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_techos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_techos_idtecho_seq RESTART;");
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LOSA MACIZA DE CONCRETO ARMADO DE 10 CMS. DE ESPESOR.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LOSA MACIZA DE CONCRETO ARMADO DE 12 CMS. DE ESPESOR.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LOSA MACISA A DOS AGUAS DE CONCRETO REFORZADO DE 10 CMS'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LOSA RETICULAR DE CONC. ARMADO DE 20 CMS, CLAROS MEDIANOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LOSA RETICULAR INCLINADA DE C.A. DE 20 CMS, CLAROS MEDIANOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LAMINA ONDULADA DE ZINC, EN CLAROS CORTOS Y MEDIANOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LAMINA ESTRUCTURAL DE ZINC, EN CLAROS CORTOS Y MEDIANOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LAMINA PINTRO, CLAROS CORTOS Y MEDIANOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LAMINA ONDULADA DE ASBESTO-CEMENTO, EN CLAROS CORTOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LAMINA ESTRUCTURAL DE ASBESTO-CEMENTO, CLAROS CORTOS'));
		
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'TEJA CRIOLLA DE BARRO, SOBRE ARTESON DE MADERA DE LA REGION'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'TEJA FRANCESA SOBRE VIGAS Y CINTAS DE MADERA DE CEDRO'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'INEXISTENTES'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LOSA DE VIGUETA DE CONCRETO Y BOVEDILLA DE POLIESTIRENO CON CAPA DE COMPRESIÓN DE FCŽ200KG/CM² DE 0.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LOSA DE VIGUETA DE CONCRETO Y BOVEDILLA DE POLISTIRENO ALIGERADA CON CASETONES. DE 0.20 CMS DE ESPES'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ESTRUCTURAL DE ASBESTO APOYADA DE EXTREMO A EXTREMO EN COLUMNAS Y VIGAS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ESTRUCTURAL DE ASBESTO APOYADA DE EXTREMO A EXTREMO EN MUROS DE CARGA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ESTRUCTURAL DE ASBESTO APOYADA DE EXTREMO A EXTREMO EN VIGAS METÁLICAS'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ESTRUCTURAL DE ASBESTO APOYADA DE EXTREMO A EXTREMO EN VIGAS DE MADERA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ASBESTO APOYADA DE EXTREMO A EXTREMO EN MUROS DE CARGA.'));
		
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ASBESTO ACANALADA APOYADA SOBRE VIGAS TIPO MONTEIN.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ASBESTO ACANALADA APOYADA SOBRE VIGAS DE MADERA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ASBESTO Y LÁMINA TRASLUCIDA PARA ILUMINACIÓN APOYADOS SOBRE MUROS DE CARGA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ASBESTO Y LÁMINA TRASLUCIDA PARA ILUMINACIÓN APOYADOS SOBRE ESTRUCTURA METÁLICA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ZINC APOYADA SOBRE MUROS DE CARGA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ZINC APOYADA SOBRE ESTRUCTURA METÁLICA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE ZINC APOYADA SOBRE VIGAS DE MADERA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA, TIPO PINTRO APOYADA SOBRE MUROS DE CARGA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA, TIPO PINTRO APOYADA SOBRE ESTRUCTURA METÁLICA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => ''));
		
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA, TIPO PINTRO APOYADA SOBRE VIGAS DE MADERA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE CARTÓN SOBRE MUROS DE CARGA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE CARTÓN SOBRE ESTRUCTURA METÁLICA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'LÁMINA ACANALADA DE CARTÓN SOBRE VIGAS DE MADERA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'BÓVEDA CATALANA PLANA SOBRE MUROS DE CARGA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'BÓVEDA CATALANA PLANA SOBRE RIELES METÁLICOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'BÓVEDA CATALANA PLANA SOBRE VIGAS DE MADERA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'BÓVEDA CATALANA (ENLADRILLADO) APOYADA SOBRE MUROS DE CARGA.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'BÓVEDA CATALANA (ENLADRILLADO) APOYADA SOBRE RIELES METÁLICOS.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'BÓVEDA CATALANA (ENLADRILLADO) APOYADA SOBRE VIGAS DE ACERO Y MADERA.'));
		
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'COVITEC DE 5 CMS. DE ESPESOR.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'COVITEC DE 8 CMS. DE ESPESOR.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'COVITEC DE 10 CMS. DE ESPESOR.'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'INEXISTENTE'));
		DB::connection('corevat')->table('cat_techos')->insert(array('techo' => 'NO APLICA'));
		
	}

}

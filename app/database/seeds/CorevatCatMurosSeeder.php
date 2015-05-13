<?php

class CorevatCatMurosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_muros')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_muros_idmuro_seq RESTART;");
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE BLOCKS DE 10X20X40 CMS.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE BLOCKS DE 12X20X40 CMS.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE BLOCKS DE 15X20X40 CMS.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE TABIQUE ROJO DE 7X14X28 CMS.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE TABIQUE DE BARRO COMPRIMIDO HUECO, TIPO POLUCA'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE TABIQUE DE BARRO COMPRIMIDO HUECO, APARENTE A 2 CARAS'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS A BASE DE MULTIPANEL'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE TABLAROCA CON CHAPA A DOS CARAS'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DIVISORIOS DE CANCELES DE ALUMINIO BLANCO COMERCIAL Y ANTE PECHO DE PLACAS DE PANEL-ART'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DIVISORIOS DE CANCELES DE ALUMINIO DURANODIK Y ANTE PECHO DE PLACAS DE PANEL-ART'));
		
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'MUROS DE PANEL "W"'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABIQUE ROJO RECOCIDO DE LA REGIÓN DE 0.14 MTS. DE ESPESOR, ASENTADO CON CEMENTO CAL Y ARENA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABIQUE ROJO RECOCIDO DE LA REGIÓN DE 0.21 MTS. DE ESPESOR, ASENTADO CON  CEMENTO CAL Y ARENA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABIQUE ROJO RECOCIDO DE LA REGIÓN DE 0.28 MTS. DE ESPESOR, ASENTADO CON  CEMENTO CAL Y ARENA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABIQUE ROJO RECOCIDO DE LA REGIÓN DE 0.30 MTS. DE ESPESOR, ASENTADO CON CEMENTO CAL Y ARENA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABIQUE DE BARRO ROJO RECOCIDO DE 5.5X12.5X25 CMS. EN 12.5 CMS., DE ESPESOR, ASENTADO CON  CEMENTO C'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABIQUE ROJO RECOCIDO DE LA REGIÓN DE 0.14 MTS. DE ESPESOR, CON VITROBLOCK'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABIQUE APARENTE VITRIFICADO, ASENTADO CON MORTERO CEMENTO CAL Y ARENA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'BLOCK DE TEPEZIL DE 0.20 MTS. DE ESPESOR, ASENTADO CON MORTERO CEMENTO CAL Y ARENA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'BLOCK DE CEMENTO DE 0.20 MTS. DE ESPESOR, ASENTADO CON MORTERO CEMENTO CAL Y ARENA.'));
		
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABLAROCA DE 0.07 MTS. DE ESPESOR TERMINADOS EN YESO LISO.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABLAROCA DE 0.10 MTS. DE ESPESOR TERMINADOS EN YESO LISO.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABLAROCA PARA DIVISIONES INTERIORES.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'TABLAROCA CON VITROBLOCK'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'DE CELOSÍA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'DIVISORIOS DE CELOSÍA.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'DE VITROBLOCK.'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'INEXISTENTE'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'SIN MURO'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'NO APLICA'));
		
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'LOSETA CERAMICA A 1/2 ALTURA'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'LOSETA CERAMICA A 1/2 ALTURA CON CENEFAS'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'LOSETA CERAMICA DE PISO A TECHO CON CENEFAS EN COCINA ACABADOS'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'LOSETA CERAMICA A 1/4 DE ALTURA A PARTIR DE LA MESETA'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'LOSETA CERAMICA A 1/4 DE ALTURA A PARTIR DE LA MESETA  CON CENEFAS O RETABLOS'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'LOSETA CERAMICA DE PISO A TECHO'));
		DB::connection('corevat')->table('cat_muros')->insert(array('muro' => 'LOSETA CERAMICA DE PISO A TECHO CON CENEFAS O RETABLOS'));
	}

}

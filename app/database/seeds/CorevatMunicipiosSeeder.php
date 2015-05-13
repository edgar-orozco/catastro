<?php

class CorevatMunicipiosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('municipios')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE municipios_idmunicipio_seq RESTART;");
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '001', 'municipio' => 'Balancán', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '002', 'municipio' => 'Cárdenas', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '003', 'municipio' => 'Centla', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '04',  'municipio' => 'CENTRO', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '005', 'municipio' => 'Comalcalco', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '006', 'municipio' => 'Cunduacán', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '007', 'municipio' => 'Emiliano Zapata', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '008', 'municipio' => 'Huimanguillo', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '009', 'municipio' => 'Jalapa', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '010', 'municipio' => 'Jalpa de Méndez', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '011', 'municipio' => 'Jonuta', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '012', 'municipio' => 'Macuspana', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '013', 'municipio' => 'Nacajuca', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '014', 'municipio' => 'Paraiso', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '015', 'municipio' => 'Tacotalp', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '016', 'municipio' => 'Teapa', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '017', 'municipio' => 'Tenosique', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '000', 'municipio' => '000', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '01',  'municipio' => 'BALANCAN', 'status' => 0));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '02',  'municipio' => 'CARDENAS', 'status' => 0));
		
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '01',  'municipio' => 'BALANCAN', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '02',  'municipio' => 'CARDENAS', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '03',  'municipio' => 'CENTLA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '05',  'municipio' => 'COMALCALCO', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '06',  'municipio' => 'CUNDUACAN', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '07',  'municipio' => 'EMILIANO ZAPATA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '08',  'municipio' => 'HUIMANGUILLO', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '09',  'municipio' => 'JALAPA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '10',  'municipio' => 'JALPA DE MENDEZ', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '11',  'municipio' => 'JONUTA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '12',  'municipio' => 'MACUSPANA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '11',  'municipio' => 'NACAJUCA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '12',  'municipio' => 'PARAISO', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '15',  'municipio' => 'TACOTALPA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '16',  'municipio' => 'TEAPA', 'status' => 1));
		DB::connection('corevat')->table('municipios')->insert(array('idestado' => 1, 'clave' => '17',  'municipio' => 'TENOSIQUE', 'status' => 1));
	}

}

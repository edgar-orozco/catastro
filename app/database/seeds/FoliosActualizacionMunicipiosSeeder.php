<?php
class FoliosActualizacionMunicipiosSeeder extends Seeder {

	public function run()
	{
		$claves = 
			"1,13
			2,8
			3,7
			4,11
			5,14
			6,2
			7,6
			8,10
			9,17
			10,16
			11,9
			12,3
			13,1
			14,15
			15,12
			16,5
			17,4";
		$originales = explode("\n", $claves);

		foreach ($originales as $original) 
		{
			list($idSicaret, $idOriginal) = explode(',', $original);
			print_r("ID Municipio del Sicaret: " . trim($idSicaret) . "\n");
						
			//Actualizacion de municipios en  folios comprados
			$folios_comprados = FoliosComprados::where('municipio_id', $idOriginal)->get();
			foreach ($folios_comprados as $folio) 
			{
				if($folio)
				{
					print_r("entra comprados " . $folio->usuario_id . "\n");
					$folio->municipio_id = trim($idSicaret);
					print_r("Guarda comprados\n");
					$folio->save();
				}
			}	
		}

	}

}
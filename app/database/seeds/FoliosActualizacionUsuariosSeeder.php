<?php
class FoliosActualizacionUsuariosSeeder extends Seeder {

	public function run()
	{
		$claves = 
			"dalila.garcia,2060
			dalila.garcia,2010
			dalila.garcia,2009
			dalila.garcia,2008
			alfredo.lopez,2010
			alfredo.lopez,2060
			";
		$originales = explode("\n", $claves);

		foreach ($originales as $original) 
		{
			list($userSicaret, $idOriginal) = explode(',', $original);
			print_r("usuario sicaret: " . trim($userSicaret));
			$userActual = User::where('username', trim($userSicaret))->first();
			//Actualizacion de folios historial
			$folios_historial = FoliosHistorial::where('id_usuario', $idOriginal)->get();
			foreach ($folios_historial as $folio) 
			{
				if($folio)
				{
					print_r("entra historial " . $folio->id_usuario . "Usuario Actual " . $userActual->id);
					$folio->id_usuario = $userActual->id;
					print_r("Guarda historial\n");
					$folio->save();
				}
			}
			
			
			//Actualizacion de folios comprados
			$folios_comprados = FoliosComprados::where('usuario_id', $idOriginal)->get();
			foreach ($folios_comprados as $folio) 
			{
				if($folio)
				{
					print_r("entra comprados " . $folio->usuario_id . "Usuario Actual " . $userActual->id);
					$folio->usuario_id = $userActual->id;
					print_r("Guarda comprados\n");
					$folio->save();
				}
			}	
		}

	}

}
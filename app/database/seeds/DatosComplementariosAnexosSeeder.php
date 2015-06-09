<?php
class DatosComplementariosAnexosSeeder extends Seeder {

	public function run()
	{
		
		//Selecciono el ultimo id
		$tipo_imagenes = TipoImagenes::orderby('id_tipoimagen', 'desc')->first();
		$ultimo_id = $tipo_imagenes->id_tipoimagen;


		//Agrego la descripcion POSTERIOR
		$tipo_imagenes = new TipoImagenes;
		$tipo_imagenes->id_tipoimagen = $ultimo_id+1;
		$tipo_imagenes->descripcion = "POSTERIOR";
		$tipo_imagenes->save();
		
		





	}

}
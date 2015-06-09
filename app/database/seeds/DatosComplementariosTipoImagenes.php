<?php
class FoliosActualizacionFechasSeeder extends Seeder {

	public function run()
	{
		

		$folios_comprados = FoliosComprados::All();
		$numRegistro = 0;
		$centinela = 0;
		foreach ($folios_comprados as $folio) 
		{
			//$numRegistro = $numRegistro + 1;

			if ($folio->fecha_entrega_m == '2015-01-01')
			{
				$folio->fecha_entrega_m = NULL;
				$centinela = 1;
			}

			if ($folio->fecha_entrega_e == '2015-01-01')
			{
				$folio->fecha_entrega_e = NULL;
				$centinela = 1;
			}
			if ($folio->municipio_id == NULL)
			{
				$folio->municipio_id = 0;
				$centinela = 1;
			}
			if ($folio->usuario_id == 0)
			{
				$folio->usuario_id = NULL;
				$centinela = 1;
			}
			if ($centinela == 1)
			{
				$folio->save();
				$centinela = 0;
				print_r("Guardado Correcto \n");
			}
			
		}

		





	}

}
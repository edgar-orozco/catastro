<?php

/**
 * Crea un usuario valuador para pruebas.
 */
class PeritosSeeder extends Seeder 
{
    public function run()
    {

    	$file = file(base_path().'/sources/peritos2015F.csv');

    	foreach ($file as $linea) 
    	{
    		list($id, $nombre, $direccion) = explode('|', $linea);
    		$perito = Perito::Find($id);
    		$perito->nombre = $nombre;
    		$perito->direccion = $direccion;
    		$perito->save();
    	}
    }
}
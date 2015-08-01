<?php

class Perito extends Eloquent {

	protected $table = 'peritos';
    protected $fillable = ['nombre','corevat','direccion','telefono','correo','Estado'];
	public function iperito(){

		return $this->hasMany('FoliosHistorial');

	}

	/**
     * Función para obtener la suma de folios entregados y autoriados por perito, ya sea Urbanos, Rusticos o ambos.
     *
     * @param $tipo = 'U' o 'R'
     * @return object
     */

	public function sumFoliosE($tipo = null)
		{
			$entregaU = FoliosComprados::selectRaw('Sum(entrega_estatal) AS entregado, COUNT(entrega_estatal) as autorizado')
				->where('perito_id', $this->id);
			if($tipo)
			{
				$entregaU->where('tipo_folio', $tipo);
			}


				
			return $entregaU->get()[0];
			
		}

	/**
     * Función para obtener ultima fecha de entrega del perito.
     * @return String
     */

	public function ultimaFechaE()
	{
		return FoliosComprados::where('perito_id', $this->id)->max('fecha_entrega_e'); 
				
				
	}

}


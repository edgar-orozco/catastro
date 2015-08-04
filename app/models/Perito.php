<?php

class Perito extends Eloquent {

	protected $table = 'peritos';
    protected $fillable = ['nombre','corevat','direccion','telefono','correo','Estado'];
	public function iperito(){

		return $this->hasMany('FoliosHistorial');

	}

	/**
     * Función para obtener la suma de folios entregados y autoriados por perito o el total, ya sea Urbanos, Rusticos o ambos.
     *
     * @param $tipo = 'U' o 'R'
     * @return object
     */

	public function sumFoliosE($tipo = null, $total = null)
		{
			$entregaU = FoliosComprados::selectRaw('Sum(entrega_estatal) AS entregado, COUNT(entrega_estatal) as autorizado');
				
			if(!strtolower($total) == 'total')
			{
				$entregaU->where('perito_id', $this->id);
			}
			if(strtolower($tipo) == 'u' || strtolower($tipo) == 'r' )
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

		$mes = array();

		$mes['1'] = "Enero";
		$mes['2'] = "Febrero";
		$mes['3'] = "Marzo";
		$mes['4'] = "Abril";
		$mes['5'] = "Mayo";
		$mes['6'] = "Junio";
		$mes['7'] = "Julio";
		$mes['8'] = "Agosto";
		$mes['9'] = "Septiembre";
		$mes['10'] = "Octubre";
		$mes['11'] = "Noviembre";
		$mes['12'] = "Diciembre";

		$date = FoliosComprados::where('perito_id', $this->id);

		$date->select(
			DB::raw('EXTRACT(YEAR FROM MAX(fecha_entrega_e)) as anio'),
			DB::raw('EXTRACT(MONTH FROM MAX(fecha_entrega_e)) as mes'),
			DB::raw('EXTRACT(DAY FROM MAX(fecha_entrega_e)) as dia'));

		if($date->get()[0]->anio)
		{
			
			$date = $date->get()[0]->dia.' de '.$mes[ $date->get()[0]->mes].' del '.$date->get()[0]->anio;
		}
		else
		{
			$date = '----';
		}

		return $date; 
	
	}


}


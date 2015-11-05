<?php
class TipoActividadResultadoInspeccionSeeder extends Seeder 
{

	//Seeder para agregar 
	public function run()
	{
		
		$tipoActividad = new TipoActividadTramite;
		$tipoActividad->nombre = "Generar resultado de la inspección";
		$tipoActividad->presente = "Generando resultado de la inspección";
		$tipoActividad->pasado = "Resultado de la inspección generada";
		$tipoActividad->callback = "tramites/resultadoInspeccion/create";
		$tipoActividad->getter = "tramites/resultadoInspeccion/show-grid";
		$tipoActividad->estatus_id = "2";
		$tipoActividad->orden = "9";
		$tipoActividad->manual = "t";
		$tipoActividad->save();


	}

}
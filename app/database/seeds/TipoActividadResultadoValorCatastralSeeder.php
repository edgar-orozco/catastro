<?php
class TipoActividadResultadoValorCatastralSeeder extends Seeder 
{

	//Seeder para agregar 
	public function run()
	{
		
		$tipoActividad = new TipoActividadTramite;
		$tipoActividad->nombre = "Generar certificado del Valor Catastral ";
		$tipoActividad->presente = "Generando certificado del Valor Catastral";
		$tipoActividad->pasado = "Resultado del Valor Catastral generada";
		$tipoActividad->callback = "ventanilla/valor";
		//$tipoActividad->getter = "ventanilla/valor/show-grid";
		$tipoActividad->estatus_id = "2";
		$tipoActividad->orden = "9";
		$tipoActividad->manual = "t";
		$tipoActividad->save();


	}

}
<?php
class TipoActividadResultadoMemoSeeder extends Seeder 
{

	//Seeder para agregar 
	public function run()
	{
		
		$tipoActividad = new TipoActividadTramite;
		$tipoActividad->nombre = "Generar certificado del Memo ";
		$tipoActividad->presente = "Generando certificado del Memo";
		$tipoActividad->pasado = "Resultado del Memo generada";
		$tipoActividad->callback = "memos/recibo";
		//$tipoActividad->getter = "ventanilla/valor/show-grid";
		$tipoActividad->estatus_id = "2";
		$tipoActividad->orden = "9";
		$tipoActividad->manual = "t";
		$tipoActividad->save();


	}

}
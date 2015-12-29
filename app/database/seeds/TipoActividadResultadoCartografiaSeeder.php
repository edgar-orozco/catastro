<?php
class TipoActividadResultadoCartografiaSeeder extends Seeder 
{

  //Seeder para agregar 
  public function run()
  {
    
    $tipoActividad = new TipoActividadTramite;
    $tipoActividad->nombre = "Generar resultado de cartografía";
    $tipoActividad->presente = "Generando resultado de cartografía";
    $tipoActividad->pasado = "Resultado de cartografía generada";
    $tipoActividad->callback = "tramites/resultadoCartografia/create";
    $tipoActividad->getter = "tramites/resultadoCartografia/show-grid";
    $tipoActividad->estatus_id = "2";
    $tipoActividad->orden = "9";
    $tipoActividad->manual = "t";
    $tipoActividad->save();


  }

}
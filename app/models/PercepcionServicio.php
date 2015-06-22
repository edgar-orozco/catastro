<?php

class PercepcionServicio extends \Eloquent {
	
	protected $guarded = ['id'];
	protected $fillable = ['id_tramite','evaluacion_ventanilla','solucion_dudas', 'trato_personal', 'tramite_satisfactorio', 
	'conocimiento_requisitos','cumplimiento_requisitos', 'sugerencias_quejas', 'created_at','updated_at'];
	protected $table = 'percepcion_servicio';
	protected $primaryKey = 'id';
	public $timestamps = false;

public static $rules = [
'evaluacion_ventanilla' => 'required',
'solucion_dudas' => 'required',
'trato_personal' => 'required',
'tramite_satisfactorio' => 'required',
'conocimiento_requisitos' => 'required',
'cumplimiento_requisitos' => 'required',
'sugerencias_quejas' => 'max:255'
];
	public function tramite(){
        return $this->hasOne('Tramites', 'id', 'id');
    }
 
}
<?php

use LaravelBook\Ardent\Ardent;

class ActividadTramite extends Ardent {
	protected $fillable = ['tramite_id','user_id','departamento_id','tipo_id','observaciones'];

    protected $table = 'actividades_tramites';
    /**
     * Bandera para poblar el objeto con el request enviado desde la forma Input::all()
     * @see https://github.com/laravelbook/ardent#updates-with-unique-rules
     * @var bool
     */
    public $autoHydrateEntityFromInput = true;

    /**
     * Bandera para purgar atributos html como el CRSF, _token, etc.
     * @see https://github.com/laravelbook/ardent#automatically-purge-redundant-form-data
     * @var bool
     */
    public $autoPurgeRedundantAttributes = true;


    public function tramite() {
       return $this->hasOne('Tramite');
    }

    public function usuario() {
       return $this->hasOne('User');
    }

    public function departamento() {
        return $this->hasOne('DepartamentoTramite','id','departamento_id');
    }

    public function tipoActividad() {
        return $this->hasOne('TipoActividadTramite','id','tipo_id');
    }


}
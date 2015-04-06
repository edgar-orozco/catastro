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

    /**
     * Cuando la actividad tiene un subtrámite asociado lo devuelve, esto es en el caso
     * cuando se ha disparado la actividad de iniciar subtrámite.
     */
    public function subtramiteAsociado(){
        $sub = null;
        if($this->tipoActividad && mb_strtolower($this->tipoActividad->presente) == 'se inicia subtrámite'){
            $sub = Tramite::where('padre_id', $this->tramite_id)->whereBetween('created_at',[$this->created_at->subSeconds(5), $this->created_at->addSeconds(5)  ])->first();
        }
        return $sub;
    }
}
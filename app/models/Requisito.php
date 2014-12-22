<?php

use LaravelBook\Ardent\Ardent;

class Requisito extends Ardent {
	protected $fillable = ['nombre','tipo','descripcion'];

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

    /**
     * Errores de validación
     * @var
     */
    protected $errors;

    /**
     * Reglas de validación
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|unique:requisitos',
        'tipo' => 'required',
        'descripcion' => 'required'
    ];

    /**
     * Devuelve los tipotramites relacionados con el requisito
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tipotramites(){
        return $this->belongsToMany('Tipotramite');
    }

}
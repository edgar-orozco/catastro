<?php

/**
 * Class Tipotramite
 */
class Tipotramite extends \Eloquent {
	protected $fillable = ['nombre','tiempo','costodsmv'];

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
        'nombre' => 'required|unique:tipotramites',
        'tiempo' => 'digits_between:0,365',
        'costodsmv' => 'digits_between:0,1000',
    ];

    /**
     * Devuelve los requisitos que pertenecen al tipotramite
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requisitos() {
        return $this->belongsToMany('Requisito');
    }


}
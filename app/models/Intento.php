<?php
use LaravelBook\Ardent\Ardent;

/**
 * Class Intento
 * Con esta clase representamos los intentos que se han hecho para iniciar un trámite
 */
class Intento extends Ardent {

    protected $fillable = ['clave', 'cuenta', 'noencontrado', 'tipotramite', 'usuario'];

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

}
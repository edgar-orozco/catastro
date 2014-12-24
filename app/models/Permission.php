<?php

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name', 'display_name'];

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
        'name' => 'required|alpha_dash|unique:permissions',
        'display_name' => 'required'
    ];

    /**
     * Devuelve el número total de permisos registrados
     * @return int
     */
    public static function totalPermissions() {
        return self::all()->count();
    }
}